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
        "dom": 'ft<"datatables__pagination_information_range"pi<"mt-3"l>>'
    })
})
