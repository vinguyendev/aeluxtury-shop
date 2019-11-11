var $                = jQuery;
var simpleTipFocus   = false;
var simpleTipTimeout = null;
var simpleTipObject  = null;
var loadOrderred     = 0; // Biến check đã load nội dung order chưa
var loadUserInfo     = 0; // Biến check đã load thông tin cá nhân chưa


function actionLogin(urlReturn = ''){
	var email 		= $(".form_login #use_email").val();
	var password 	= $(".form_login #use_password").val();
	var url_return = urlReturn;
	if(url_return == '') url_return 	= url_base;

	if(email == "" || password == ""){
		$(".form_login .error_msg").html('Vui lòng nhập đủ thông tin !');
		return false;
	}else{
		showloading();
		$(".form_login .error_msg").html("");
		$.ajax({
			type: "POST",
			url: "/ajax/ajax_login.php",
			data: {email: email, password: password, url_return: url_return},
			success: function(data){
				hideloading();
				if(data.code == 1){
					window.location.href = data.url_return;
				}else{
					$(".form_login .error_msg").html(data.msg);
				}
			},
			dataType: "json"
		});
	}
}

function resizeWindow(){
}

/**
 * [showOverlay Hien thi box xem nhanh]
 */
function showOverlay(obj_class){
	$("body").css("overflow", "hidden");
	$("#overlayContent").removeAttr('class');
	$("#overlayContent").removeAttr('style');
	$("#overlayContent").attr('class', "overlayContent");
	$("#overlayContent").addClass(obj_class);
	var obj			= $(".overlay");
	obj.fadeIn(200);
}

/**
 * [del_overlay An box xem nhanh]
 * @return {[type]} [description]
 */
function del_overlay(){
	$('.overlay').hide();
	$("body").css("overflow","auto");

	//Xóa nội dung trước đó
	$("#overlay_center").html('');

	//Xóa các class đã add vào pjax_content, giữ lại class mặc định là pjax_content
	$("#overlayContent").removeAttr('class');
	$("#overlayContent").removeAttr('style');
	$("#overlayContent").attr('class', "overlayContent");
	if(!$.browser.msie){
		window.history.pushState("", "", url_site);
	}
}

function enterKey(e, value){
   var key;
   if(window.event){
      key = window.event.keyCode;
   }else{
      key = e.which;
   }
   if(key == 48 || key == 49|| key == 50|| key == 51|| key == 52|| key == 53|| key == 54|| key == 55|| key == 56|| key == 57|| key == 8 || key == 9){}
   else{
      $("#note").val("Số điện thoại chỉ bao gồm chữ số !");
      $("#note").css("display", "block");
      $("#use_phone").focus();
      $("#usf_phone").focus();
      value = String(value);
      //lấy độ dài chuỗi
      var a = value.length;
      //bẻ chuỗi thành mảng
      var arr = value.split("");
      //duyệt mảng và bỏ đi phần tử k phải số
      for(i=0; i<arr.length; i++){
      	arr[i]	= parseInt(arr[i], 10);
         if(arr[i] === 0 || arr[i] == 1 || arr[i] == 2 || arr[i] == 3 || arr[i] == 4 || arr[i] == 5 || arr[i] == 6 || arr[i] == 7 || arr[i] == 8 || arr[i] == 9){}
         else{ arr[i] = null; }
      }
      //ghép mảng thành chuỗi
      value = arr.toString();
      //bỏ dấu ',' tự sinh khi ghép mảng thành chuỗi, chữ 'g' để thay thế tất cả dấu ','(global)
      value = value.replace(/,/gi, "");
      $("#use_phone").val(value);
      $("#usf_phone").val(value);
   }
}

/**
 * [popup Bat cua so lien ket tai khoan BaoKim]
 * @param  {[type]} url [description]
 * @return {[type]}     [description]
 */
function popup(url) {
	var width	= 632;
	var height	= 400;
	var left		= (screen.width  - width)/2;
	var top		= (screen.height - height)/2;
	var params	= 'width='+width+', height='+height;
	params		+= ', top='+top+', left='+left;
	params		+= ', location=1';
	params		+= ', menubar=no';
	params		+= ', resizable=no';
	params		+= ', scrollbars=no';
	params		+= ', status=no';
	params		+= ', toolbar=no';
	var newwin	= window.open(url,'windowname5', params);
	if(newwin) newwin.focus();

	return false;
}

/**
 * Show box loading
 * @return {[type]} [description]
 */
function showloading(){
	$('#loading').show();
}

/**
 * Hide box loading
 * @return {[type]} [description]
 */
function hideloading(){
	$('#loading').fadeOut();
}

/*-- Initiate On Load --*/
/**
 * Function được thực thi ngay ở footer
 * @return {[type]} [description]
 */
function footerLoad(){
} 

function addProductToCart(productId, quantity, type = 0){
	showloading();
	$.ajax({
		url: "/ajax/ajax_add_to_cart.php",
		type: "POST",
		data: {iPro : productId, quantity:quantity},
		success: function(data){
			if(data.code !== undefined && data.code == 1){
				window.location.href = '/cart.html';
			}else if(data.code !== undefined && data.code == 0){
				alert(data.mess);
			}
		},
		dataType : "json"
		});
}

function recountCart(productId, quantity ,type="recount"){
    $.ajax({
        type: "POST",
        url: "/ajax/ajax_recount_product.php",
        data: {productId: productId, quantity: quantity, type: type},
        success: function(data){
            if(data.code == 1){
                window.location.reload();
            }else{
                alert(data.msg);
            }
        },
        dataType: "json"
    });
}

function addCart2(id){
	var pro_id = id;
	if(pro_id > 0){
		addProductToCart(pro_id,1);
	}
}	

/**
 * Function được thực thi khi document ready
 * @return {[type]} [description]
 */
function initLoad(){
	/* Hide box Overlay */
	$('.detailPin').live('click', function(){
		del_overlay();
	});

	$("#backToTop").click(function(){
		moveScrollTop($('body'));
	});
} /*End document readly*/

/**
 * Function thực thị sau khi full load
 * @return {[type]} [description]
 */
function initLoaded(){
}
/*-- End Initiate On Load --*/

