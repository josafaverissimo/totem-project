let mainDatatable = null

document.addEventListener("DOMContentLoaded", () => {
    mainDatatable = $(".main-table").DataTable({
        "language": {
            "decimal": "",
            "emptyTable": "Nenhum dado na tabela",
            "info": "Exibindo de _START_ à _END_ de _TOTAL_ linhas",
            "infoEmpty": "Exbindo 0 à 0 de 0 linhas",
            "infoFiltered": "(Filtrados de _MAX_ linhas)",
            "infoPostFix": "",
            "thousands": ".",
            "lengthMenu": "Exibir _MENU_ linhas",
            "loadingRecords": "Carregando...",
            "processing": "",
            "search": "Pesquisar:",
            "zeroRecords": "Nenhuma linha encontrada",
            "paginate": {
                "first": "Primeiro",
                "last": "Último",
                "next": "Próximo",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": "Ordenar colunas de forma crescente",
                "sortDescending": "Ordenar colunas de forma decrescente"
            }
        },
        "dom": '<"datatables__filter flex flex-jbet flex-icent"f>t<"datatables__pagination_information_range"pi<"mt-3"l>>',
        "order": [[0, "desc"]]
    })
    const tableFormLink = document.getElementById("main-table").dataset.formLink
    const linkToForm = '<div class="pd-3"><a href="' + tableFormLink + '" class="btn btn-outline-dark btn-sm">Adicionar</a></div>'
    $(".datatables__filter").prepend(linkToForm)

    document.querySelectorAll(".buttons-control .edit").forEach(function (button) {
        button.addEventListener("click", function (event) {
            const element = event.target
            let hash = element.closest("[data-hash]").dataset.hash

            window.location.href = tableFormLink + "/" + hash
        })
    })

    document.querySelectorAll(".buttons-control .delete").forEach(function (button) {
        button.addEventListener("click", function (event) {
            const deleteButton = document.getElementById("delete-button")
            const element = event.target
            const hash = element.closest("[data-hash]").dataset.hash
            const deleteModalRow = document.querySelector(".delete-modal-row")
            const row = element.closest("tr")

            row.setAttribute("id", "delete-row")

            deleteModalRow.innerHTML = ''
            row.querySelectorAll("td").forEach(function (td) {
                const data = td.textContent
                    .replace(/ +/g, " ")
                    .replace(/^ /, "")

                const newTdElement = document.createElement("td")
                newTdElement.textContent = data

                deleteModalRow.append(newTdElement)
            })

            deleteButton.setAttribute("data-hash", hash)

            $("#delete-modal").modal("show")
        })
    })
})
