$(document).ready(function() {
	var folder = null;
	
	console.log("{{URL__}}");
	
        /* -- on envoie le lock 1 */
        $('#button-next').click(function(e){
          e.preventDefault();
          $.post('{{URL_}}uploadAjax/', $('#block1').serialize())
          .done(function(data) {
            data = JSON.parse(data);

            if(data['STATUT'] == 1){

              folder = data['CONTENT'];
			  $('#folder').val(folder);
			  $('#disabled').css("display", "none");
			  $(".btn-finale").attr('href', '{{URL_}}folder/'+folder+'/');

            }
            else{

              console.log(data['CONTENT']);
            }

          })

          .fail(function(data) {
            alert('Error: ' + data);
          });


        });


        /* - on envoie le block 2 */
        $('#files').on('change', function(e){
      //  $('#block2').on('submit', function(e){
            e.preventDefault();

            var data = new FormData();

            // var $form = $('#block2');
            // var formdata = new FormData($form[0]); //(window.FormData) ? new FormData($form[0]) : null;
            // var data = (formdata !== null) ? formdata : $form.serialize();

            var $form = $('#block2');
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var data = (formdata !== null) ? formdata : $form.serialize();

            $.ajax( {
              url: '{{URL_}}UPLfiles/',
              type: 'POST',
              contentType: false, // obligatoire pour de l'upload
              processData: false, // obligatoire pour de l'upload
              data: data,
              success: function (response) {
				response = JSON.parse(response);

				if(response['STATUT'] == 1){
					for(var i = 0; i < response['NAMEORIGIN'].length; i ++){						
						$('.list-file').append('<div class="item item-'+response['NAMEFILERDG'][i]+'"><div class="remove" data-id='+response['NAMEFILERDG'][i]+'>X</div>'+response['NAMEORIGIN'][i]+'</div>');
					}
				}
				else{

				  console.log(response['CONTENT']);
				}
              }
            })

          } );

		  
		  $('.list-file').on('click', '.remove', function(){
			var key = $(this).data('id');
			 $.ajax({
				type: 'POST',
				url: '{{URL_}}deleteFileAjax/',
				data:  'fold='+folder+'&file='+key,
				dataType: "html",
				success : function(data){
					data = JSON.parse(data);
					if(data['STATUT'] == 1){
						$('.item-'+key).remove();
					}
				},
				error : function(data){
					console.log(data);
				}
			});
		  });

    $("#button-next").addClass("disabled");

    verify("#mail_exp");
    verify("#mail_rec");
    verify("#content");
    verify("#subject");
   });

    function verify(key){
      $(key).keyup(function(){
        if($(key).hasClass("invalid") || $(key).val()=='') {
            $("#button-next").addClass("disabled");
          }

          verifyAll(["#mail_exp", "#mail_rec", "#content", "#subject"]);
      });
    }

    function verifyAll(inputs){
      var error= 0;
      for(var i=0; i<inputs.length; i++){
        if($(inputs[i]).hasClass("invalid") || $(inputs[i]).val() == '') {
          error++;
        }
      }
		console.log(error);
        if(error==0){
          <!-- $("#button-next").removeClass("disabled"); -->
		  $("i").removeClass("disabled"); 
        }
    }