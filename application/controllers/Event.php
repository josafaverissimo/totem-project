<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function index()
    {
        $this->load->model("Event_model", "event");
        $this->load->model("EventCategory_model", "eventCategory");

        $data = [
            "events" => array_map(function ($event) {
                $eventCategoryId = $event->events_category_id;
                $event->category = $this->eventCategory->getBy("id", $eventCategoryId)['name'];

                return $event;
            }, $this->event->getAll()),
            "title" => "Relive",
            "styles" => [
                "public/assets/css/base_datatables.css",
                "public/assets/datatables/css/datatables.css",
                "public/assets/css/toastify.css"
            ],
            "scripts" => [
                "public/assets/datatables/js/datatables.js",
                "public/assets/js/base_datatables.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/base_table.js"
            ]
        ];

        $this->load->view('pages/event/index', $data);
    }

    public function form($eventHash = null)
    {
        $this->load->model("Client_model", "client");
        $this->load->model("EventCategory_model", "eventCategory");

        $event = [
            "name" => null,
            "eventsCategoryId" => null,
            "active" => null
        ];
        $eventClientsHashs = [];
        $editMode = !empty($eventHash);
        $formAction = $editMode ? base_url("event/edit/$eventHash") : base_url("event/create");

        if ($editMode):
            $this->load->model("Event_model", "event");

            $event = $this->event->getBy("hash", $eventHash);
            $eventClientsHashs = array_map(function ($client) {
                return $client['hash'];
            }, $this->event->getEventClients($event['id']));
        endif;

        $clients = $this->client->getAll();
        $eventsCategories = $this->eventCategory->getAll();

        $data = [
            "title" => "Relive",
            "event" => $event,
            "eventClientsHashs" => $eventClientsHashs,
            "editMode" => $editMode,
            "formAction" => $formAction,
            "clients" => $clients,
            "eventsCategories" => $eventsCategories,
            "styles" => [
                "public/assets/adminlte/plugins/select2/css/select2.min.css",
                "public/assets/css/toastify.css"
            ],
            "scripts" => [
                "public/assets/js/jqueryMask.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/formvalidation.js",
                "public/assets/adminlte/plugins/select2/js/select2.full.min.js",
                "public/assets/js/base_form.js",
                "public/assets/js/event/form.js"
            ]
        ];

        $this->load->view('pages/event/form', $data);
    }

    private function formValidation(): array
    {
        $this->load->library('form_validation');
        $this->load->helper("custom_form_validation_functions");

        $fieldsRules = [
            [
                "field" => "name",
                "label" => "Nome",
                "rules" => "trim|required"
            ],
            [
                "field" => "clients[]",
                "label" => "Clientes",
                "rules" => "trim|required"
            ],
            [
                "field" => "category",
                "label" => "Categoria",
                "rules" => "trim|required"
            ],
            [
                "field" => "background",
                "label" => "Background",
                "rules" => "trim|required"
            ],
        ];

        $this->form_validation->set_rules($fieldsRules);

        if (!$this->form_validation->run()):
            return [
                "success" => false,
                "errors" => $this->form_validation->error_array()
            ];
        endif;

        return [
            "success" => true
        ];
    }

    private function uploadBackground($filename)
    {
        if (!file_exists("./public/uploads")):
            mkdir("./public/uploads", 755);
        endif;

        $config['upload_path'] = "./public/uploads";
        $config['file_name'] = $filename;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 9000;

        $this->load->library('upload', $config);

        $uploadStatus = $this->upload->do_upload('background');
        $data = $this->upload->data();
        $errors = $this->upload->display_errors();


        return [
            "success" => $uploadStatus,
            "data" => $data,
            "errors" => $errors
        ];
    }

    public function create()
    {
        $post = $this->input->post();
        $response = [
            "success" => false,
            "messages" => [
                "success" => [],
                "failed" => ["nenhum dado enviado"]
            ]
        ];

        if (!empty($post)):
            $response['messages']['failed'] = [];

            $this->load->model("Event_model", "event");
            $this->load->model("EventCategory_model", "eventCategory");

            $formValidation = $this->formValidation();
            if (!$formValidation['success']):
                header("Content-type: application/json");
                echo json_encode([
                    "formValidation" => $formValidation["errors"]
                ]);
                return;
            endif;

            $timestamp = (new DateTime)->getTimestamp();
            $filename = $timestamp;
            $backgroundUploadOperation = $this->uploadBackground($filename);

            if (!$backgroundUploadOperation["success"]):
                $response['messages']['failed'][] = str_replace(["<p>", "</p>", "."], "", $backgroundUploadOperation["errors"]);
                echo json_encode($response);

                return;
            endif;

            $filenameUploaded = $backgroundUploadOperation['data']['file_name'];
            $eventCategoryId = $this->eventCategory->getByHash($post['category'])['id'];

            $eventCreateOperation = $this->event->create(
                $post['name'],
                $eventCategoryId,
                $post['active'],
                $filenameUploaded
            );

            if ($eventCreateOperation):
                $response['success'] = true;
                $response['messages']['success'][] = "Evento Criado com sucesso";
                $eventLastId = $this->event->getLastInsertId();

                $this->load->model("Client_model", "clientModel");

                foreach ($post['clients'] as $client):
                    $clientId = $this->clientModel->getByHash($client)['id'];
                    $this->event->linkClientToEvent($eventLastId, $clientId);
                endforeach;
            else:
                $response['messages']['success'][] = "Houve um problema ao criar o evento";
            endif;
        endif;

        header("Content-type: application/json");
        echo json_encode($response);
    }

    public function edit($hash)
    {
        $post = $this->input->post();
        $response = [
            "success" => false,
            "messages" => [
                "success" => [],
                "failed" => ["nenhum dado enviado"]
            ]
        ];

        if (!empty($post)):
            $response['messages']['failed'] = [];

            $this->load->model('Event_model', 'event');
            $this->load->helper("filtering_helper");

            $event = $this->event->getBy("hash", $hash);

            $data = getFieldsIfNotEmpty([
                "name",
                "category",
                "clients",
                "active"
            ], $post);

            if (isset($_FILES['background'])):
                $timestamp = (new DateTime)->getTimestamp();
                $filename = $timestamp;
                $backgroundUploadOperation = $this->uploadBackground($filename);

                if (!$backgroundUploadOperation["success"]):
                    $response['messages']['failed'][] = str_replace(["<p>", "</p>", "."], "", $backgroundUploadOperation["errors"]);
                    echo json_encode($response);

                    return;
                endif;

                unlink("./public/uploads/{$event['background']}");
                $data['background'] = $backgroundUploadOperation['data']['file_name'];
            endif;

            if (!empty($data['category'])):
                $this->load->model("EventCategory_model", "eventCategory");

                $data['events_category_id'] = $this->eventCategory->getBy("hash", $data['category'])['id'];
                unset($data['category']);
            endif;

            if (!empty($data['clients'])):
                $this->load->model("Client_model", "clientModel");

                foreach ($data['clients'] as $client):
                    $clientId = $this->clientModel->getByHash($client)['id'];
                    $this->event->unlinkClientToEvent($event['id']);
                    $this->event->linkClientToEvent($event['id'], $clientId);
                endforeach;
            endif;

            if (!empty($data)):
                $success = $this->event->edit($event['id'], $data);

                if ($success):
                    $response['success'] = true;
                    $response['messages']['success'][] = "Evento editado com sucesso";
                else :
                    $response['messages']['failed'][] = "Ocorreu um erro durante o processo de edição";
                endif;
            endif;
        endif;

        header("Content-type: application/json");
        echo json_encode($response);
    }

    public function delete($hash)
    {
        $this->load->model("Event_model", "event");

        $response = [
            "success" => false,
            "messages" => [
                "success" => [],
                "failed" => []
            ]
        ];

        $event = $this->event->getByHash($hash);
        $this->event->unlinkClientToEvent($event['id']);
        unlink("./public/uploads/{$event['background']}");
        $deleteEventStatus = $this->event->delete($event['id']);

        if ($deleteEventStatus):
            $response['messages']['success'][] = "Cliente deletado com sucesso";
            $response["success"] = true;
        else:
            $response['messages']['failed'][] = "Ocorreu um erro durante o processo deleção";
        endif;

        header("Content-type: application/json");
        echo json_encode($response);
    }
}
