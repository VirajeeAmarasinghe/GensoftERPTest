$(function () {

    var timer = null;
    
    var has_discount=false;

    $("#div-discount").hide();
          
    var table = $('#yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: url_car_list,
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'ref_no', name: 'REF NO'},
              {data: 'name', name: 'CAR NAME'},
              {data: 'model.name', name:'CAR MODEL'},
              {data: 'model.brand.name', name:'CAR BRAND'},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
    });

    $("#nic_number").keydown(function(){ 
        clearTimeout(timer); 
        timer = setTimeout(hasDiscount, 2000); 
    });

    $('#nic_number').keyup(function () { 
        this.value = this.value.replace(/[^a-zA-Z0-9]/g,'');
    });

    function hasDiscount(){ 
        //call the ajax call
        let person_nic=$("#nic_number").val(); 

        $.ajax({
            url: url_has_discount,
            type: "GET",
            data: {"person_nic": person_nic},
            success: function(response){
                if(response.has_discount){
                    has_discount=true;
                    $("#div-discount").show();
                }
            },
            error: function(response){
                alert("Error Occurred.Try Again!");
            }
        });
    }

    $("#btn-submit-invoice").click(function(e){
        e.preventDefault();
        var postData=new FormData($("#car-form")[0]);

        $("#person_name_error").text("");
        $("#nic_number_error").text("");
        $("#car_reference_num_error").text("");
        $("#car_number_plate_error").text("");
        $("#renting_price_error").text("");
        $("#num_hrs_error").text("");
        $("#discount_error").text("");
        $("#total_cost_error").text("");

        $.ajax({
            data: postData,
            url: url_store_invoice,
            type: "POST",
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            success: function(response){ 
                alert(response.message);
                window.location.href = "/car";
            },
            error: function(response){ 
                if(response.responseText!=""){
                    if(response.message!=undefined && response.message!=""){
                        alert(response.message);
                    }
                    
                    var errors=$.parseJSON(response.responseText);
                    $.each(errors.errors, function(key, val){
                        $("#"+key+"_error").text(val[0]);
                    });
    
                }
                
            }
        });
    });

    $("#num_hrs").keydown(function(){
        clearTimeout(timer); 
        timer = setTimeout(calculation, 1000);
    });

    $('#num_hrs').keyup(function () { 
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    function calculation(){ 
        let num_hrs=parseFloat($("#num_hrs").val());
        let rent_per_hr=parseFloat($("#renting_price").val());

        let subTot=num_hrs*rent_per_hr;

        if(has_discount){
            let discount=subTot*3/100;
            $("#discount").val(discount.toFixed(2));
            subTot=subTot-discount;
        }

        $("#total_cost").val(subTot.toFixed(2));

    }

    $("#btn-submit").click(function(e){
        e.preventDefault();
        var postData=new FormData($("#car-form")[0]);
    
        //clear validation error messages
        $("#car_model_error").text("");
        $("#car_name_error").text("");
        $("#car_color_error").text("");
        $("#eng_number_error").text("");
        $("#chas_number_error").text("");
        $("#rent_price_error").text("");
        $("#number_plate_error").text("");
        $("#car_trans_error").text("");
        
        $.ajax({
            data: postData,
            url: url_store_car,
            type: "POST",
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            success: function(response){ 
                alert(response.message);
                window.location.href = "/car";
            },
            error: function(response){ 
                if(response.responseText!=""){
                    if(response.message!=undefined && response.message!=""){
                        alert(response.message);
                    }
                    
                    var errors=$.parseJSON(response.responseText);
                    $.each(errors.errors, function(key, val){
                        $("#"+key+"_error").text(val[0]);
                    });
    
                }
                
            }
        });
    });
      
});



