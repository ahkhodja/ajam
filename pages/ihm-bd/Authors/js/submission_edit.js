/**
 * Created by URTI on 24/01/2016.
 */
/**
 * Created by URTI on 20/12/2015.
 */
$(document).ready(function() {
    var ida=$('#ida').val();
    $("#area option[value='"+$("#area_edit").val()+"']").prop('selected', true);
    $("#type option[value='"+$("#type_edit").val()+"']").prop('selected', true);
    var numimg=0;
    var nbco=parseInt($("#co_numm").val());
    console.log(nbco);
    $('#image_progresse').hide();
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
        return false;

    });
    $('#add').click(function(e){
        alert($("#co_numm").val());
        nbco=nbco+1;
        alert("#co"+nbco);

        $('#co'+nbco).append("<div class=\"row\"><p class=\"text-center\">Co-auteur "+nbco+"</p> </div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">First Name : </label> <div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_fn"+nbco+"\" placeholder =\"First Name ... \" name=\"co_fn"+nbco+"\"> </div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Middle Name : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_mn"+nbco+"\" placeholder =\"Middle Name ... \"name=\"co_mn"+nbco+"\"></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Last Name : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_ln"+nbco+"\" placeholder =\"last Name ... \" name=\"co_ln"+nbco+"\"></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Affiliation : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_af"+nbco+"\" placeholder =\"affiliation ... \" name=\"co_af"+nbco+"\"></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Adresse: </label><div class=\"col-lg-8\"><textarea  class=\"form-control\" id=\"co_ad"+nbco+"\" placeholder =\"Middle Name ... \" rows=\"3\" name=\"co_ad"+nbco+"\"></textarea></div></div></div><div class=\"row\"><div class=\"form-group\"><label for=\"text\" class=\"col-lg-2 control-label\">Email : </label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control\" id=\"co_em"+nbco+"\" placeholder =\"Email ... \" name=\"co_em"+nbco+"\"></div></div></div>");
        $('#co'+nbco).after("<span id=\"co"+(nbco+1)+"\"></span>");
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
            $("#image_info #image_upl tr").remove();
        $( "#image_upl" ).clone().appendTo( "#image_info" );

        $("#image_info #image_upl tr .action").remove();

            return false;}

    );
    $("#next_4").click(function(e) {
        e.stopPropagation();
        var data_sub=$('#form').serialize();
        var main_file=$("#file_title").html();
        data_sub=data_sub+"&main_file="+main_file;
        for(var i=1;i<=numimg;i++)
        {
            data_sub=data_sub+"&image"+i+"="+$("#image_title"+i+"").html()  ;
        }
        data_sub=data_sub+"&nb_co="+nbco;
        data_sub=data_sub+"&nb_im="+numimg;
        console.log(data_sub);
        $.ajax({
            type:"POST",
            url:"php/submit_article.php",
            data: data_sub,async:false,
            success:function(data)
            {
                if(data == 1)
                {
                    alert("ok");
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
            $('#file_title').html(input.val().replace(/\\/g, '/').replace(/.*\//, '')) ;
            var fileInput=document.getElementById('main');
            $("#file_taille").html((fileInput.files[0].size/1024/1024).toFixed(2)+' Mo');
            $("#file_type").html($("#type_file").val());
            var data= new FormData();
            data.append('ajax','true');
            data.append('file',fileInput.files[0]);
            data.append('id',15);
            var request= new XMLHttpRequest();
            request.upload.addEventListener('progress',function(event) {
                if (event.lengthComputable) {
                    var percent = event.loaded / event.total;
                    var progresse = Math.round(percent * 100);
                    $('#main_progresse').width(progresse+'%');
                    $('#main_progresse').html(progresse+'%');
                    if(progresse==100) {
                        $('#add_images').show();
                    }
                }

            });
            request.upload.addEventListener('load',function(event){



            });
            request.upload.addEventListener('error',function(event){
                alert('upload fail');
            });
            request.open('POST','fichier.php');
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
                url:"php/existe.php",
                data: 'file=' +input.val().replace(/\\/g, '/').replace(/.*\//, '')+'&ida='+ida+'',async:false,
                success:function(data)
                {
                    if(data == 1)
                    {
                        alert("le fichier existe deja")
                    }
                    else
                    {
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

                                $('#image_progresse').width(progresse+'%');
                                $('#image_progresse').html(progresse+'%');
                            }
                            if(progresse==100){

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
                                var index = $("#image_upl tr").index(courant.parent());
                                console.log(index);
                                var old=$("#image_upl .old").length;
                                var num_totale=$("#image_upl tr").length;

                                var val=((index+2)-old)-1;
                                console.log("index"+(index+2));
                                console.log("old"+(old-1));
                                console.log("val"+val);
                                for(var j=(index+2);j<=num_totale;j++){

                                    $("#image_upl tr:nth-child("+j+") td:nth-child(1)").attr('id',"image_title"+val+"");
                                    $("#image_upl tr:nth-child("+j+") td:nth-child(2)").attr('id',"image_extension"+val+"");
                                    $("#image_upl tr:nth-child("+j+") td:nth-child(3)").attr('id',"image_size"+val+"");
                                    val++;
                                }
                                $("#image_upl tr:nth-child("+(index+1)+")").fadeOut("slow",function(){$(this).remove();numimg=$("#image_upl .new").length;console.log("nbimage:"+numimg);});


                            });


                        });
                        request.upload.addEventListener('error',function(event){
                            alert('upload fail');
                            $(".block tr:nth-child("+(numimg+1)+")").remove();
                        });
                        request.open('POST','php/fichier_edit.php');
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
    $(".delete_im").on('click',function(){
        var courant=$(this).parent();
        var index = $("#image_upl tr").index(courant.parent());
        var file=$("#image_upl tr:nth-child("+(index+1)+") td:nth-child(1)").text();


        $.ajax({
            type:"POST",
            url:"php/unlink.php",
            data: 'file=' + file+'&ida='+ida+'',async:false,
            success:function(data)
            {
                if(data == 1)
                {
                    $("#image_upl tr:nth-child("+(index+1)+")").hide("slow", function(){ $(this).remove(); });
                }
                else
                {


                }
            }


        });


        $(".image_upl tr:nth-child("+(index+1)+")").remove();
        numimg=$(".image_upl tr").length;


    });


});
