const o=new bootstrap.Modal($("#modalAction"));$(".btn-add").on("click",function(){let a=$(this).data().url;$.ajax({method:"get",url:a,success:function(e){$("#modalAction").find(".modal-dialog").html(e),o.show(),c()}})});$("#table").on("click",".action",function(){let n=$(this).data(),a=n.url,e=n.type;e=="delete"?Swal.fire({icon:"warning",title:"Apakah Anda Yakin?",text:"Data akan dihapus secara permanen!",showCancelButton:!0,confirmButtonColor:"#d33",cancelButtonColor:"#3085d6",confirmButtonText:"Ya, Hapus!",cancelButtonText:"Batal"}).then(t=>{t.isConfirmed&&$.ajax({method:"DELETE",url:a,headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},success:function(s){window.LaravelDataTables.table.ajax.reload(),Swal.fire("Terhapus!","Data telah dihapus.","success")}})}):e=="edit"?$.ajax({method:"get",url:a,success:function(t){$("#modalAction").find(".modal-dialog").html(t),o.show(),c()}}):$.ajax({method:"get",url:a,success:function(t){$("#modalAction").find(".modal-dialog").html(t),o.show()}})});function c(){$("#formAction").on("submit",function(n){n.preventDefault();const a=this,e=new FormData(a),t=this.getAttribute("action");$.ajax({method:"POST",url:t,data:e,processData:!1,contentType:!1,headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},success:function(s){window.LaravelDataTables.table.ajax.reload(),Swal.fire("Tersimpan!","Data telah disimpan.","success"),o.hide()},error:function(s){var l;let i=(l=s.responseJSON)==null?void 0:l.errors;if($(".invalid-feedback").remove(),$(".is-invalid").removeClass("is-invalid"),i)for(const[r,d]of Object.entries(i))$(`[name='${r}']`).parent().append(`<span class="invalid-feedback">${d}</span>`),$(`[name='${r}']`).addClass("is-invalid")}})})}
