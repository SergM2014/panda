$(document).ready(function () {
    $('#table1').DataTable(populateSurveysTable());
});

document.onclick =  function(e){
    if(e.target.classList.contains('deleteSurvey')) {
        
    if ( confirm('delete given survey ?')) {
        let id = e.target.dataset.id;
        let token = document.getElementsByName('csrf-token')[0].content;
       
        let formData = new FormData;
        formData.append('id', id);
        formData.append('token', token);
        formData.append('ajax', true);
       
        fetch( '/admin/survey/delete',{
            method: 'post',
            body: formData,
            credentials: 'same-origin'
         }
        )
        .then(response => response.status)
        .then(status => {
            if(status == 200) { 
                window.location.replace("/admin?id="+id+"&delete=true");
            }
            }) 
        }
    }

    if(e.target.classList.contains('updateSurvey')) {
        let id = e.target.dataset.id;

        if ( confirm('update given survey ?')) {
            window.location.replace("/admin/survey/edit?id="+id);
        }
    }    
}

function populateSurveysTable() {
    return {
        ajax: {
            url: '/admin/user/survey',
            dataSrc: ""
        },
        columns: [
            { data: 'id' },
            { data: 'header' },
            {data: null,
                render: function(data, type, row, meta)
                    {
                       let obj = JSON.parse(data.responses);
                       var values = Object.keys(obj).map(function (key) { return ' '+obj[key]; });
                        
                        return values;
                    }
                },
            {data: null,
                render: function(data, type, row, meta)
                    {
                       let obj = JSON.parse(data.results);
                       var values = Object.keys(obj).map(function (key) { return ' '+obj[key]; });
                        
                        return values;
                    }
                },

            { data: 'status' },
            { data: null,
                render: function(data, type, row, meta)
                    {
                    return `<button class="updateSurvey btn btn-warning" data-id= ${data.id} >Update Survey</button> `
                    }
            },
            { data: null,
                render: function(data, type, row, meta)
                    {
                    return `<button class="deleteSurvey btn btn-danger" data-id= ${data.id} >Delete Survey</button> `
                    }
            }
        ],
        
        "pageLength": 3,
        "bDestroy": true,
        "columnDefs": [
            {"className": "dt-center", "targets": "_all"}
            ],
    
    }
}