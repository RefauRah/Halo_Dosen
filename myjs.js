$('.matkul').select2({
        placeholder: "Pilih Mata Kuliah",
        allowClear: true
    }); 
(function() {

    $('#add').click(function() {
		$('.matkul').select2("destroy");
		$('.matkul')
			.removeAttr('data-live-search')
			.removeAttr('data-select2-id')
			.removeAttr('aria-hidden')
            .removeAttr('tabindex')
            .removeAttr('disabled')
            .removeAttr('aria-disabled')
            .removeAttr('aria-selected');
        //var source = $('.test-container');
        //var item = $('.test')[0].outerHTML;
		
		var noOfDivs = $('.test0').length;
		var clonedDiv = $('.test0').first().clone(true);
		clonedDiv.insertBefore("#clonedItem");
		clonedDiv.attr('id', 'test' + noOfDivs);
        
		$('.matkul').select2({
			placeholder: "Pilih Mata Kuliah",
			allowClear: true
		}); 
        initDelete();
    });
	
	function initDelete(){
		$('.btnRemove').on('click', function(){
			var parent = $(this).parent();
			parent.remove();
		});
	}
	
	initDelete();
})();

$(function() {
  $( "#penerima" ).autocomplete({
    source: 'cari.php'
  });
});

$(function() {
  $( "#pengesah" ).autocomplete({
    source: 'cari.php'
  });
});

$(document).ready(function() { 
    $("#dosen").select2({
        placeholder: "Pilih Dosen Penerima",
        allowClear: true
    }); 
});

$(document).ready(function() { 
    $("#dosen-2").select2({
        placeholder: "Pilih Dosen Pengesah",
        allowClear: true
    }); 
});