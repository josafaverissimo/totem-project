document.addEventListener("DOMContentLoaded", () => {
    $(".main-table").DataTable({
        "language": {
            "decimal":        "",
            "emptyTable":     "Nenhum dado na tabela",
            "info":           "Exibindo de _START_ à _END_ de _TOTAL_ linhas",
            "infoEmpty":      "Exbindo 0 à 0 de 0 linhas",
            "infoFiltered":   "(Filtrados de _MAX_ linhas)",
            "infoPostFix":    "",
            "thousands":      ".",
            "lengthMenu":     "Exibir _MENU_ linhas",
            "loadingRecords": "Carregando...",
            "processing":     "",
            "search":         "Pesquisar:",
            "zeroRecords":    "Nenhuma linha encontrada",
            "paginate": {
                "first":      "Primeiro",
                "last":       "Último",
                "next":       "Próximo",
                "previous":   "Anterior"
            },
            "aria": {
                "sortAscending":  "Ordenar colunas de forma crescente",
                "sortDescending": "Ordenar colunas de forma decrescente"
            }
        },
        "dom": '<"datatables__filter flex flex-jbet flex-icent"f>t<"datatables__pagination_information_range"pi<"mt-3"l>>',
        "order": [[0, "desc"]]
    })

    const linkToForm = '<div class="pd-3"><a href="' + BASE_URL +'user/form" class="btn btn-outline-primary btn-sm">Adicionar</a></div>'

    $(".datatables__filter").prepend(linkToForm)
})
