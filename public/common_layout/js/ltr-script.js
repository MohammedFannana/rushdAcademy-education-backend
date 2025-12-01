function fnAdjustLTRView()
{
	if($(window).width()>1095){}
	else
	{
		$('.system-modal .accordion').find('.accordion-box').each(function(i,e){
			$(e).find('.header').addClass('d-block text-left').css({'padding-left':0,'padding-right':0});
			$(e).find('.header span').eq(0).addClass('d-inline');
			$(e).find('.header').find('svg').parent('span').addClass('d-inline float-right').css({'padding-left':0,'padding-right':10});
		});
	}
}

$(document).ready(function(){
	fnAdjustLTRView();
	
	$(window).resize(function(){fnAdjustLTRView();});
	
	if($('div.sidebar-main').length>0){
			$('div.sidebar-main div.bar').attr('tab-index',1).css('z-index','10');
			$('div.sidebar-main div.bar div').attr('tab-index',2).css('z-index','-1');
			
			var sidebarTop=0,maxMarginNeg=0;
			var sideBarObj=$(".bar.scroll-wrapper").find('.list').eq(0);
			
			$(".bar.scroll-wrapper").find('.list').find('.icon').height(sideBarObj.find('.icon').height());
			maxMarginNeg=$(window).height()-$('.company-logo').outerHeight()-$(".bar.scroll-wrapper").find('.list:last').offset().top+sideBarObj.height()-20;
			
			function moveContent() {
				sideBarObj.css("margin-top",sidebarTop);
			}
			
			sideBarObj.parent('div').bind('mousewheel DOMMouseScroll', function (event){
				 if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
					  if(sidebarTop<0){
							sidebarTop +=60;
							moveContent();
					  }
				 }
				 else {
					if($(window).height() - sideBarObj.height() <= $(".bar.scroll-wrapper").find('.list:last').offset().top){
							sidebarTop -=60;
							moveContent();
						}
				 }
			});
			
			$(document).keydown(function(e){
				//console.log(e.keyCode);
				if (e.keyCode == 38) { 
					if(sidebarTop<0){
						sidebarTop +=10;
						moveContent();
					}
				}
				else if (e.keyCode == 40) { 
					if($(window).height() - sideBarObj.height() <= $(".bar.scroll-wrapper").find('.list:last').offset().top){
						sidebarTop -=10;
						moveContent();
					}
				}
				else if (e.keyCode == 35) { //end
					sidebarTop =maxMarginNeg;
					moveContent();
				}
				else if (e.keyCode == 36) { //home
					sidebarTop =0;
					moveContent();
				}
			});
		}//sidebar-exists
	
});