function fnAdjustRTLView()
{
	if($(window).width()>1095){
		$('.top-bar .grid-menu.column-3').each(function(i,e){
			$(e).parent('.toooltip-content').css({'transform':'translateX(70%)'});
		});
		$('.nav-bar .video-button').each(function(i,e){
			$(e).parent('div').find('.toooltip-content').css({'transform':'translateX(75%)'});
		});
		
		$('.nav-bar-bottom').find('.popup').each(function(i,e){
			if(i>3){
				$(e).find('.popup-content').css('transform','translateX('+((i==7)?20:0)+'%)');
			}
		});
	}//>1095
	else
	{
		var transX=[100,80,78,66,50,38,20];
		$('.m-top-bar .toooltip .toooltip-content').each(function(i,e){
			$(e).attr('style', $(e).attr('style') + '; ' + 'transform: translateX(-'+transX[i]+'%) !important');
			/*if(i>0 && i%2==0) transX -=22;
			else if(i>0 && i%3==0) transX -=12;
			else if(i==1) transX=80;
		
			if(i>0 && i%4==0) transX +=8;
			
			if(i<=6)
				$(e).attr('style', $(e).attr('style') + '; ' + 'transform: translateX(-'+transX+'%) !important');
			
			if(i>0 && i%4==0) transX -=14;
			else if(i==1) transX=100;*/
		});
		
		$('.system-modal .accordion').find('.accordion-box').each(function(i,e){
			$(e).find('.header').addClass('d-block text-left').css({'padding-left':0,'padding-right':0});
			$(e).find('.header span').eq(0).addClass('d-inline');
			$(e).find('.header').find('svg').parent('span').addClass('d-inline float-right');
		});
		
	}//<-1095
}//element-view

$(document).ready(function()
{
		fnAdjustRTLView();
		
		$(window).resize(function(){fnAdjustRTLView();});
		
		if($('div.sidebar-main').length>0 && $(window).width()>1095){
			
			$('div.sidebar-main div.scroll-wrapper,div.sidebar-main div.scroll-content').attr('tab-index',1).css('z-index','9999');
			
			$('div.sidebar-main div.scroll-content div.scroll-scrolly_visible div').attr('tab-index',2).css('z-index','-1');
			
			$('.nav-item .right-arrow').css({'margin-right':'auto','margin-left':0});
			$('.nav-item svg.fa-chevron-right').addClass('fa-chevron-right').addClass('fa-chevron-left');
			
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
			
			$(".sidebar-main .bar .list .list-button").click(function(){
				$('.nav-dropdown').find('ul.subnav').css('display','none');
				setTimeout(function(){
					$('.nav-dropdown').find('ul.subnav').css('display','inline');
				},200);
				
				if($(this).parent('.list').find('.sidebar-dropdown').length==0){
					
				}
			});
			$(".sidebar-main .bar .list .nav-dropdown .nav-close").click(function(){
				$('.nav-dropdown').find('ul.subnav').css('display','none');
				setTimeout(function(){
					$('.nav-dropdown').find('ul.subnav').css('display','inline');
				},200);
			});
		}//sidebar-exists
		
});