
/* Confirm box alert while delete a record */
function confirm_delete(e) {
    $.confirm({
        title: "Delete Confirmation",
        message: "You are about to delete this record. <br />It cannot be restored at a later time! Continue?",
        buttons: {
            Yes: {
                "class": "yes",
                action: function() {
                    window.location = BaseURL + e
                }
            },
            No:  function(event, ui) {
              $(this).remove();
            }
        }
    })
}

/* number validation */
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }
/* number validation ends */

/* number with decimal point (float data type) validation start */
function floatKeyUp(eve) {
    if ($(this).val().indexOf('.') == 0) {
      $(this).val($(this).val().substring(1));
    }

  }
  
  function floatKeypress(eve) {
  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0)) {
    eve.preventDefault();
  floatKeyUp(eve);
  }
}

/* number with decimal point (float data type) validation ends */

/* go back button */
function goBack(e) {
  window.location = BaseURL + e ;
}
/* go back button end */

/* password generator starts */
function generatePassword() {
    var length = 8,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}
/* password generator ends */

function getPwd() {
    var tmp = generatePassword();
    $('#user_pwd').val(tmp) ;
}

/* branch listing datatable */
 //$('#dev_memberList').DataTable();
 
/* data load by ajax to datatable  starts */
$(document).ready(function(){

    $( "div.alert-success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 ); 
     
    $('#dev_branchList').focus();
    var dataTable = $('#dev_branchList').DataTable({
        responsive: true,
        "language": {
        "sZeroRecords": "No Branch Added..",
        'processing': "loading",
        },
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        //  "scrollY":        "250px",
        "scrollCollapse": true,
        //'searching': false, // Remove default Search Control
        'ajax': {
            'url':  BaseURL+"branch-pageLoad",
            'data': function(data){

            }
        },
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }],

    });

});  
/* data load by ajax to datatable  ends */

/* save branch start */
 $('#dev_addBranch').submit(function(e){
     
    e.preventDefault();

    var me = $(this);

    $.ajax({

        url : me.attr('action'),
        type : 'post',
        data : me.serialize(),
        dataType : 'json',
        success : function(response) {
            //alert(response.success);
            if (response.success == true) {

                window.location.href=BaseURL+'branch-master';
            } else {
                $.each(response.messages, function(key, value) {

                    var element = $('#'+ key);
                    element.closest('div.form-group').removeClass('has-error').addClass(value.length > 0 ? 'has-error' : 'has-success').find('.text-danger').remove();
                    element.after(value);
                });
            }
        }
    });
   
});

/* save branch ends */


/* department --- data load by ajax to datatable  starts */
$(document).ready(function(){

    $( "div.alert-success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 ); 
     
    $('#dev_departList').focus();
    
    departmentSearch();
});  

function departmentSearch() {
      $('#dev_departList').dataTable().fnDestroy();
    var dataTable = $('#dev_departList').DataTable({
        responsive: true,
        "language": {
        "sZeroRecords": "No Department Added..",
        'processing': "loading",
        },
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        //  "scrollY":        "250px",
        "scrollCollapse": true,
        //'searching': false, // Remove default Search Control
        'ajax': {
            'url':  BaseURL+"department/pageLoad",
            'data': function(data){
                data.name_search    = $('#dev_departNameSearch').val();
                data.branch_search = $('#dev_departBranchSearch').val();
            }
        },
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }],

    });
}
/* data load by ajax to datatable  ends */

/* save deparment start */
 $('#dev_addDepartment').submit(function(e){
     
    e.preventDefault();

    var me = $(this);

    $.ajax({

        url : me.attr('action'),
        type : 'post',
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        dataType : 'json',
        success : function(response) {
            //alert(response.success);
            if (response.success == true) {

                window.location.href=BaseURL+'department-master';
            } else {
                $.each(response.messages, function(key, value) {

                    var element = $('#'+ key);
                    element.closest('div.form-group').removeClass('has-error').addClass(value.length > 0 ? 'has-error' : 'has-success').find('.text-danger').remove();
                    element.after(value);
                });
            }
        }
    });
   
});

/* save department ends */


/* customer --- data load by ajax to datatable  starts */
$(document).ready(function(){

    $( "div.alert-success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 ); 
     
    $('#dev_customerList').focus();
    customerSearch();

});  
function customerSearch() {
      $('#dev_customerList').dataTable().fnDestroy();
    var dataTable = $('#dev_customerList').DataTable({
        responsive: true,
        "language": {
        "sZeroRecords": "No Customer Added..",
        'processing': "loading",
        },
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        //  "scrollY":        "250px",
        "scrollCollapse": true,
        //'searching': false, // Remove default Search Control
        'ajax': {
            'url':  BaseURL+"Customer/pageLoad",
            'data': function(data){
              data.name_search    = $('#dev_cusNameSearch').val();
              data.mob_search = $('#dev_cusMobSearch').val();
              
            }
        },
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }],

    });
   }
/* data load by ajax to datatable  ends */

/* save customer start */
 $('#dev_addCustomer').submit(function(e){
     
    e.preventDefault();

    var me = $(this);

    $.ajax({

        url : me.attr('action'),
        type : 'post',
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        dataType : 'json',
        success : function(response) {
            //alert(response.success);
            if (response.success == true) {

                window.location.href=BaseURL+'customer-master';
            } else {
                $.each(response.messages, function(key, value) {

                    var element = $('#'+ key);
                    element.closest('div.form-group').removeClass('has-error').addClass(value.length > 0 ? 'has-error' : 'has-success').find('.text-danger').remove();
                    element.after(value);
                });
            }
        }
    });
   
});

/* save customer ends */

/* product type change start */

function productTypeCols(id='') {
  if($('#dev_prdService').is(':checked')) { 
        $.ajax({
            url: BaseURL + 'getPrdFields',
            type: 'POST',
            data: { prdType:'SERVICE',bid:id
             
            },
            success: function (data) {
               $('#dev_prdFieldLoad').html(data);

               if(id!='')
               {
                setRequireToTime();
               }
             
            } 
          });
       /* $(".dev_service").attr('required', ''); 
        $(".dev_sale").removeAttr('required');*/
       }
      if($('#dev_prdSell').is(':checked')) { 
         $.ajax({
            url: BaseURL + 'getPrdFields',
            type: 'POST',
            data: { prdType:'SALE',bid:id
             
            },
            success: function (data) {
               $('#dev_prdFieldLoad').html(data);
             
            } 
          });
       /* $('#dev_prdServiceCol').hide();
        $('#dev_prdSellCol').show();
        $(".dev_sale").attr('required', ''); 
        $(".dev_service").removeAttr('required');*/
       }
}
/* product type change ends */
/* product department timing required */
function setRequireToTime() {
    if($('#dev_prdService').is(':checked')) { 
         $('.pdTime').removeAttr('required');
        checked = $("input[type=checkbox]:checked").length;

        
           
            $(':checkbox:checked').each(function(i){
            dval = $(this).val();
            $("#max_"+dval).attr('required','required');
            $("#med_"+dval).attr('required','required');
            $("#min_"+dval).attr('required','required');
            });
       
    }
}
/* product department timing required end */
/* save product start */
 $('#dev_addProduct').submit(function(e){
     
    e.preventDefault();

    var me = $(this);
    if($('#dev_prdService').is(':checked')) { 
        checked = $("input[type=checkbox]:checked").length;

        if(!checked) {
            $('#dept_error').html("You must check at least one department.");
            return false;
        }else{
            $.ajax({

        url : me.attr('action'),
        type : 'post',
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        dataType : 'json',
        success : function(response) {
            //alert(response.success);
            if (response.success == true) {

                window.location.href=BaseURL+'product-master';
            } else {
                $.each(response.messages, function(key, value) {

                    var element = $('#'+ key);
                    element.closest('div.form-group').removeClass('has-error').addClass(value.length > 0 ? 'has-error' : 'has-success').find('.text-danger').remove();
                    element.after(value);
                });
            }
        }
    });
        }
    }else{

        $.ajax({

        url : me.attr('action'),
        type : 'post',
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        dataType : 'json',
        success : function(response) {
            //alert(response.success);
            if (response.success == true) {

                window.location.href=BaseURL+'product-master';
            } else {
                $.each(response.messages, function(key, value) {

                    var element = $('#'+ key);
                    element.closest('div.form-group').removeClass('has-error').addClass(value.length > 0 ? 'has-error' : 'has-success').find('.text-danger').remove();
                    element.after(value);
                });
            }
        }
    });

    }   
    
   
});

/* save product ends */

/* product --- data load by ajax to datatable  starts */
$(document).ready(function(){

    $( "div.alert-success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 ); 
     
    $('#dev_productrList').focus();
    productSearch();

});  
function productSearch() {
      $('#dev_productList').dataTable().fnDestroy();
    var dataTable = $('#dev_productList').DataTable({
        responsive: true,
        "language": {
        "sZeroRecords": "No Product Added..",
        'processing': "loading",
        },
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        //  "scrollY":        "250px",
        "scrollCollapse": true,
        //'searching': false, // Remove default Search Control
        'ajax': {
            'url':  BaseURL+"Product/pageLoad",
            'data': function(data){
              data.name_search    = $('#dev_prdNameSearch').val();
              data.type_search = $('#dev_prdTypeSearch').val();
              
            }
        },
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }],

    });
   }
/* data load by ajax to datatable  ends */


/* department --- data load by ajax to datatable  starts */
$(document).ready(function(){

    $( "div.alert-success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 ); 
     
    $('#dev_userList').focus();
    
    userSearch();
});  

function userSearch() {
      $('#dev_userList').dataTable().fnDestroy();
    var dataTable = $('#dev_userList').DataTable({
        responsive: true,
        "language": {
        "sZeroRecords": "No User Added..",
        'processing': "loading",
        },
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        //  "scrollY":        "250px",
        "scrollCollapse": true,
        //'searching': false, // Remove default Search Control
        'ajax': {
            'url':  BaseURL+"user/pageLoad",
            'data': function(data){
                data.name_search    = $('#dev_userNameSearch').val();
                data.branch_search = $('#dev_userBranchSearch').val();
                data.manager_search = $('#dev_userManagerSearch').val();
            }
        },
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }],

    });
}
/* data load by ajax to datatable  ends */

/* save user start */
 $('#dev_addUser').submit(function(e){
     
    e.preventDefault();

    var me = $(this);
    checked = $("input[type=checkbox]:checked").length;

        if(!checked) {
            $('#dept_error').html("You must check at least one department.");
            return false;
        }else{

    $.ajax({

        url : me.attr('action'),
        type : 'post',
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        dataType : 'json',
        success : function(response) {
            //alert(response.success);
            if (response.success == true) {

                window.location.href=BaseURL+'user-master';
            } else {
                $.each(response.messages, function(key, value) {

                    var element = $('#'+ key);
                    element.closest('div.form-group').removeClass('has-error').addClass(value.length > 0 ? 'has-error' : 'has-success').find('.text-danger').remove();
                    element.after(value);
                });
            }
        }
    });
}
   
});

/* save uuser ends */

/* load manager list start */
$(document).ready(function(){

     
      $("#manager_Name").select2({
          ajax: { 
              url: '<?= base_url() ?>Branch/getManager',
              type: "post",
              dataType: 'json',
              delay: 250,
              data: function (params) {
                  return {
                      searchTerm: params.term // search term
                  };
              },
              processResults: function (response) {
                  return {
                    results: response
                  };
              },
              cache: true
          }
      }); 
     
       
      $('#manager_Name').on('change', function() {
          //alert( this.value );
          var option = $('option:selected', this).attr("s");
          //alert(option);
        });
});
/* load manager list end */