$( document ).ready(function() {
	$('#btnOK').click(function() {
		if (!confirm('สั่งซื้อเรียบร้อยแล้วค่ะ')) {
			return false;	
		}
	});
	
});