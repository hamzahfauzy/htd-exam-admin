$('.datatable').on('draw.dt', function (e, settings, json, xhr) {
    console.log('draw')
    document.querySelector('.datatable').parentNode.classList.add('table-responsive')
}).dataTable({
    // stateSave:true,
    pagingType: 'full_numbers_no_ellipses',
    search: {
        return: true
    },
    aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
})