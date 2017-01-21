/**
 * Created by URTI on 20/12/2015.
 */
$(document).ready(function() {

    var ida=$('#ida').val();
    var etat=$('#etat').val();
    var ee=$('#ee').val();
    $('#progresse_main').hide();
    $('.state').hide();
    $("#area option[value='"+$("#area_edit").val()+"']").prop('selected', true);
    $("#type").find("option[value='"+$("#type_edit").val()+"']").prop('selected', true);
    var numimg=0;
    $('#add_images').hide();
    $('.table_image').hide();
    var nbco=parseInt($("#co_numm").val());

    $("#next_1").click(function(e) {

        e.stopPropagation();
        current_div = $(this).parent();
        next_div = $(this).parent().next();
        next_div.show();
        current_div.hide();
        $(".etape_progresse a").eq($(".partie").index(current_div)).removeClass("encours");
        $(".etape_progresse a i").eq($(".partie").index(current_div)).removeClass("fa fa-pencil fa-1x pull-right");
        $(".etape_progresse a i").eq($(".partie").index(current_div)).addClass("fa  fa-check fa-1x pull-right");
        $(".etape_progresse a").eq($(".partie").index(next_div)).addClass("encours");
        $(".etape_progresse a i").eq($(".partie").index(next_div)).addClass("fa  fa-pencil fa-1x pull-right");
        $('#remove').prop('disabled', false);
        if(nbco==0){


            $('#remove').prop('disabled', true);
        }
        return false;

    });
    $('#add').click(function(e){
        if(nbco==0){
            nbco=nbco+1;
            $('#debut').after("<span id=\"co"+nbco+"\"></span>");
            $('#co'+nbco).append("<div class=\"row\"><p class=\"text-center\">Co-auteur 1</p> </div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">First Name : </label> <div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_fn"+nbco+"\" placeholder =\"First Name ... \" name=\"co_fn"+nbco+"\"> </div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Middle Name : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_mn"+nbco+"\" placeholder =\"Middle Name ... \"name=\"co_mn"+nbco+"\"></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Last Name : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_ln"+nbco+"\" placeholder =\"last Name ... \" name=\"co_ln"+nbco+"\"></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Affiliation : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_af"+nbco+"\" placeholder =\"affiliation ... \" name=\"co_af"+nbco+"\"></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Adresse: </label><div class=\"col-lg-8\"><textarea  class=\"form-control\" id=\"co_ad"+nbco+"\" placeholder =\"Middle Name ... \" rows=\"3\" name=\"co_ad"+nbco+"\"></textarea></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Email : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_em"+nbco+"\" placeholder =\"Email ... \" name=\"co_em"+nbco+"\"></div></div></div>");
            $('#co'+nbco).after("<span id=\"co"+(nbco+1)+"\"></span>");




        }else{
            nbco=nbco+1;

            $('#co'+nbco).append("<div class=\"row\"><p class=\"text-center\">Co-auteur "+nbco+"</p> </div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">First Name : </label> <div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_fn"+nbco+"\" placeholder =\"First Name ... \" name=\"co_fn"+nbco+"\"> </div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Middle Name : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_mn"+nbco+"\" placeholder =\"Middle Name ... \"name=\"co_mn"+nbco+"\"></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Last Name : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_ln"+nbco+"\" placeholder =\"last Name ... \" name=\"co_ln"+nbco+"\"></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Affiliation : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_af"+nbco+"\" placeholder =\"affiliation ... \" name=\"co_af"+nbco+"\"></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Adresse: </label><div class=\"col-lg-8\"><textarea  class=\"form-control\" id=\"co_ad"+nbco+"\" placeholder =\"Middle Name ... \" rows=\"3\" name=\"co_ad"+nbco+"\"></textarea></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Email : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_em"+nbco+"\" placeholder =\"Email ... \" name=\"co_em"+nbco+"\"></div></div></div>");
            $('#co'+nbco).after("<span id=\"co"+(nbco+1)+"\"></span>");}
        if(nbco!=0){ $('#remove').prop('disabled', false);}
        return false;

    });
    $('#remove').click(function(e){


        $('#co'+nbco).remove();
        $('#co'+(nbco+1)).remove();
        if(nbco!=1){
            $('#co'+(nbco-1)).after("<span id=\"co"+nbco+"\"></span>");}else{$('#debut').after("<span id=\"co"+nbco+"\"></span>")
            $('#remove').prop('disabled', true);
        }
        nbco=nbco-1;
        return false;

    });
    $("#next_2").click(function(e) {
        e.stopPropagation();
        current_div = $(this).parent();
        next_div = $(this).parent().next();
        next_div.show();
        current_div.hide();
        $(".etape_progresse a").eq($(".partie").index(current_div)).removeClass("encours");
        $(".etape_progresse a i").eq($(".partie").index(current_div)).removeClass("fa fa-pencil fa-1x pull-right");
        $(".etape_progresse a i").eq($(".partie").index(current_div)).addClass("fa  fa-check fa-1x pull-right");
        $(".etape_progresse a").eq($(".partie").index(next_div)).addClass("encours");
        $(".etape_progresse a i").eq($(".partie").index(next_div)).addClass("fa  fa-pencil fa-1x pull-right");
        return false;

    });
    $("#next_3").click(function(e) {
        e.stopPropagation();
        current_div = $(this).parent();
        next_div = $(this).parent().next();
        next_div.show();
        current_div.hide();
        $(".etape_progresse a").eq($(".partie").index(current_div)).removeClass("encours");
        $(".etape_progresse a i").eq($(".partie").index(current_div)).removeClass("fa fa-pencil fa-1x pull-right");
        $(".etape_progresse a i").eq($(".partie").index(current_div)).addClass("fa  fa-check fa-1x pull-right");
        $(".etape_progresse a").eq($(".partie").index(next_div)).addClass("encours");
        $(".etape_progresse a i").eq($(".partie").index(next_div)).addClass("fa  fa-pencil fa-1x pull-right");

        $('#titre').text($('#title').val());
        $('#type_article').text($('#type').val());
        $('#area_article').text($('#area').val());
        $('#abstract_article').text($('#abstract').val());
        $('#keyword_article').text($('#keywords').val());
        for (var p=1;p<=3;p++){
            $("#re_fn"+p+"_article").text($("#re_fn"+p).val());
            $("#re_mn"+p+"_article").text($("#re_mn"+p).val());
            $("#re_ln"+p+"_article").text($("#re_ln"+p).val());
            $("#re_ln"+p+"_article").text($("#re_ln"+p).val());
            $("#re_em"+p+"_article").text($("#re_em"+p).val());
        }
        $("#co_auteur").html('');
        for(var i=nbco;i>=1;i--) {
            $("#co_auteur").after(" <div id=\"co_"+i+"\"> <div class=\"row\"><p class=\"text-center\">Co-auteur " + i + "</p> </div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">First Name : </label><div class=\"col-lg-8\"><label for=\"text\" class=\" control-label text-left texte\"id=\"cof_fn"+i+"\"> </label></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Middle Name : </label><div class=\"col-lg-8\"><label for=\"text\" class=\" control-label text-left texte\"id=\"cof_mn" + i + "\" > </label></div> </div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Last Name : </label><div class=\"col-lg-8\"><label for=\"text\" class=\" control-label text-left texte\"id=\"cof_ln" + i + "\" > </label> </div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Affiliation : </label><div class=\"col-lg-8\"><label for=\"text\" class=\" control-label text-left texte\"id=\"cof_af" + i + "\" > </label></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Adresse : </label><div class=\"col-lg-8\"><label for=\"text\" class=\" control-label text-left texte\"id=\"cof_ad" + i + "\" > </label></div> </div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">E-mail : </label><div class=\"col-lg-8\"><label for=\"text\" class=\" control-label text-left texte\"id=\"cof_em" + i + "\" > </label></div></div></div></div>");
            $("#cof_fn"+i+"").text($("#co_fn"+i+"").val());
            $("#cof_mn"+i+"").text($("#co_mn"+i+"").val());
            $("#cof_ln"+i+"").text($("#co_ln"+i+"").val());
            $("#cof_af"+i+"").text($("#co_af"+i+"").val());
            $("#cof_ad"+i+"").text($("#co_ad"+i+"").val());
            $("#cof_em"+i+"").text($("#co_em"+i+"").val());
        }

        $('#f_title').text($('#file_title').html());
        $('#f_type').text($('#file_type').html());
        $('#f_taille').text($('#file_taille').html());
        $("#image_info tr").remove();

        if($('.block tr').length!=0){

            for(var i=1;i<=numimg;i++)
            {
                $("#val_im").show();
                $("#image_info").append("<tr><td id=\"i_title"+i+"\" class=\"text-center\">"+$("#image_title"+i+"").html()+"</td><td id=\"i_type"+i+"\" class=\"text-center\">"+$("#image_extension"+i+"").html()+"</td><td id=\"i_taille"+i+"\" class=\"text-center\">"+$("#image_size"+i+"").html()+"</td></tr>");
            }
        }else{
            $("#val_im").hide();
        }
        return false;}

    );
    $("#next_4").click(function(e) {
        e.stopPropagation();
        current_div = $(this).parent();
        next_div = $(this).parent().next();
        next_div.show();
        current_div.hide();
        var data_sub=$('#form').serialize();
        var main_file=$("#file_title").html();
        main_file=main_file.replace(/ /g, "_");
        var size_file=$("#file_taille").html();
        var ext_file=$("#file_type").html();
        data_sub=data_sub+"&main_file="+main_file;
        data_sub=data_sub+"&size_file="+size_file;
        data_sub=data_sub+"&ext_file="+ext_file;
        data_sub=data_sub+"&d="+ee;

        for(var i=1;i<=numimg;i++)
        {
            data_sub=data_sub+"&image"+i+"="+$("#image_title"+i+"").html()  ;
            data_sub=data_sub+"&imagee"+i+"="+$("#image_extension"+i+"").html()  ;
            data_sub=data_sub+"&images"+i+"="+$("#image_size"+i+"").html()  ;
        }
        data_sub=data_sub+"&nb_co="+nbco;
        data_sub=data_sub+"&nb_im="+numimg;
        data_sub=data_sub+"&id_article="+ida;
        data_sub=data_sub+"&etat="+etat;
        console.log(data_sub);
        $.ajax({
            type:"POST",
            url:"revision_validate2.php",
            data: data_sub,async:false,dataType: "json",
            success:function(data)
            {
                if(data[0] == 1)
                {
                    window.location.href="../usr_home.php?t="+data[1] ;
                }
                else
                {


                }
            }


        });

        return false;
    });
    $("#prev_1").click(function(){
        current_div = $(this).parent();
        previous_div = $(this).parent().prev();
        previous_div.show();
        current_div.hide();
        easing: 'easeInOutBack'
        return false;

    });
    $("#prev_2").click(function(){
        current_div = $(this).parent();
        previous_div = $(this).parent().prev();
        previous_div.show();
        current_div.hide();
        easing: 'easeInOutBack'
        return false;

    });
    $("#prev_3").click(function(){
        current_div = $(this).parent();
        previous_div = $(this).parent().prev();
        previous_div.show();
        current_div.hide();
        easing: 'easeInOutBack'
        for(var i=nbco;i>=1;i--) {
            $("#co_"+i).remove();      }
        return false;

    });

    function getExtension(filename)
    {
        var parts = filename.split(".");
        return (parts[(parts.length-1)]);
    }
    function verifFileExtension(champ,listeExt)
    {   var resultat=false;
        filename = document.getElementById(champ).value.toLowerCase();
        fileExt = getExtension(filename);
        for (i=0; i<listeExt.length; i++)
        {
            if ( fileExt == listeExt[i] )
            {
                resultat=true;
            }
        }

        return resultat;
    }
    $(document).on('change', '#main', function(){



        var input = $(this);
        var extensionsValides;
        var file_t=$("#type_file").val();
        if(file_t=="latex"){
            extensionsValides=new Array('tex');
        }else
        {
            if(file_t=="word") {
                extensionsValides=new Array('doc','docx','avi');
            }
        }
        var res=verifFileExtension('main',extensionsValides);
        if (res){
            $('#state_progresse').width('0%');
            $('#progresse_main').show();
            $('.state').show();
            $('#file_title').html(input.val().replace(/\\/g, '/').replace(/.*\//, '')) ;
            var fileInput=document.getElementById('main');
            $("#file_taille").html((fileInput.files[0].size/1024/1024).toFixed(2)+' Mo');
            $("#file_type").html($("#type_file").val());
            var data= new FormData();
            data.append('ajax','true');
            data.append('file',fileInput.files[0]);
            data.append('idarticle',ida);
            var request= new XMLHttpRequest();
            request.upload.addEventListener('progress',function(event) {
                if (event.lengthComputable) {
                    var percent = event.loaded / event.total;
                    var progresse = Math.round(percent * 100);
                    $('#main_progresse').width(progresse+'%');
                    $('#main_progresse').html(progresse+'%');
                    $('#state_progresse').width(progresse+'%');
                    if(progresse==100) {
                        $('#add_images').show();
                        setTimeout(function()
                        {
                            $('.state').hide(100);

                        }, 3000);
                    }
                }

            });
            request.upload.addEventListener('load',function(event){



            });
            request.upload.addEventListener('error',function(event){
                alert('upload fail');


            });
            request.open('POST','revision_file_upload.php');
            request.setRequestHeader('Cache-control','no-cache');
            request.send(data);

        }else
        {
            alert('type de fichier invalide');
        }



    });
    $(document).on('change', '#image', function() {


        extensionsValides=new Array('jpg','gif','png');
        var input = $(this);
        var imgInput=document.getElementById('image');
        var res=verifFileExtension('image',extensionsValides);

        if (res){

            $.ajax({
                type:"POST",
                url:"existe.php",
                data: 'file=' +input.val().replace(/\\/g, '/').replace(/.*\//, '')+'&ida='+ida+'',async:false,
                success:function(data)
                {
                    if(data == 1)
                    {
                        alert("le fichier existe deja")
                    }
                    else
                    {
                        $('#state_progresse').width('0%');
                        $('#progresse_main').show();
                        $('.state').show();
                        var data= new FormData();

                        data.append('ajax','true');
                        data.append('file',imgInput.files[0]);
                        data.append('idarticle',ida);
                        var request= new XMLHttpRequest();
                        request.upload.addEventListener('progress',function(event) {
                            if (event.lengthComputable) {
                                $(".progress ").show();
                                var percent = event.loaded / event.total;
                                var progresse = Math.round(percent * 100);

                                $('#state_progresse').width(progresse+'%');
                            }
                            if(progresse==100){
                                setTimeout(function()
                                {
                                    $('.state').hide(100);

                                }, 2000);
                                $(".table_image").show();

                                $(".table_image tbody").append("<tr class='new'><td  class=\"text-center\" id=\"image_title"+(numimg+1)+"\">"+input.val().replace(/\\/g, '/').replace(/.*\//, '')+"</td><td class=\"text-center\"id=\"image_extension"+(numimg+1)+"\">"+getExtension(input.val()).toUpperCase()+"</td><td class=\"text-center\"id=\"image_size"+(numimg+1)+"\">"+(imgInput.files[0].size/1024).toFixed(2)+' ko'+"</td><td class='action'><button type=\"button\" class=\"btn btn-danger btn_smal delete_im_o\" id=\"delete_im\"><i class =\"fa fa-trash-o fa-1x \"></i></button></td></tr>");
                                $('#img_title').html(input.val().replace(/\\/g, '/').replace(/.*\//, '')) ;
                                $("#img_taille").html((imgInput.files[0].size/1024).toFixed(2)+' ko');
                                $("#img_type").html(getExtension(input.val()).toUpperCase());
                                $('#image_progresse').show("slow");
                                $(".progress ").fadeOut(2000, function(){
                                    $('#image_progresse').width('0%');
                                    $('#image_progresse').html('0%');  });
                                numimg=numimg+1;

                            }
                            console.log("finiupload"+numimg);
                        });
                        request.upload.addEventListener('load',function(event){

                            $(".delete_im_o").on('click',function(){
                                var courant=$(this).parent();
                                var index = $(".block tr").index(courant.parent());
                                var file=$(".block tr:nth-child("+(index+1)+") td:nth-child(1)").text();
                                $.ajax({
                                    type:"POST",
                                    url:"unlink.php",
                                    data: 'file=' + file+'&ida='+ida+'',async:false,
                                    success:function(data)
                                    {
                                        if(data == 1)
                                        {
                                            $(".block tr:nth-child("+(index+1)+")").hide("slow", function(){ $(this).remove();numimg--;

                                                if(numimg==0){
                                                    $(".table_image").hide('slow');
                                                }
                                            });
                                        }
                                        else
                                        {


                                        }
                                    }


                                });



                                for(var j=(index+2);j<=numimg;j++){

                                    $(".block tr:nth-child("+j+") td:nth-child(1)").attr('id',"image_title"+(j)+"");
                                    $(".block tr:nth-child("+j+") td:nth-child(2)").attr('id',"image_extension"+(j)+"");
                                    $(".block tr:nth-child("+j+") td:nth-child(3)").attr('id',"image_size"+(j)+"");


                                }


                                // numimg=$(".block tr").length;
                                console.log(numimg);

                            });


                        });
                        request.upload.addEventListener('error',function(event){
                            alert('upload fail');
                            $(".block tr:nth-child("+(numimg+1)+")").remove();
                        });
                        request.open('POST','revision_file_upload.php');
                        request.setRequestHeader('Cache-control','no-cache');
                        request.send(data);

                    }
                }


            });



        }else
        {
            alert('type de fichier invalide');
        }
    });
    $("#delete").click(function(){
        $('#file_title').html('------');
        $("#file_taille").html('------');
        $("#file_type").html('------');
        $('#main_progresse').width('0%');
        $('#main_progresse').html('0%');
    });


});
/**
 * Created by TOSHIBA on 17/10/2016.
 */
