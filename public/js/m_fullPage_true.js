// JavaScript Document
//手机滚屏参数
    $(document).ready(function() {
        $('#fullpage').fullpage({
			//滚屏节点需要添加锚点，数组形式添加，以div【class="section"】为一屏
			anchors: ['page1', 'page2', 'page3', 'page4', 'page5', 'page6', 'page7', 'page8', 'page9', 'page10', 'page11', 'page12', 'page13', 'page14', 'page15', 'page16', 'page17', 'page18', 'page19', 'page20'],
			menu: '#uptop',//菜单设定，该属性与 anchors 的值对应；该处仅作回第一屏【返回顶部】使用
			scrollingSpeed:660,//滚动速度，单位为毫秒
			//以下为首页文字动画
			//【--首屏动画效果--】
			afterRender: function() {
				$('.dn_lding').fadeIn(500);
				$('.sp1').each(function() {
					var $rel = $(this).attr('rel');
					var $arr = $rel.split(',');
					$(this).animate({
						left: $arr[2] + 'px',
//						top: $arr[3] + 'px'
					}, 760);
				});
				$('.ts1a').each(function() {
					var $rel = $(this).attr('rel');
					var $arr = $rel.split(',');
					$(this).animate({
						left: $arr[2] + 'px',
//						top: $arr[3] + 'px'
					}, 890);
				});
				$('.ts1b').each(function() {
					var $rel = $(this).attr('rel');
					var $arr = $rel.split(',');
					$(this).animate({
						left: $arr[2] + 'px',
//						top: $arr[3] + 'px'
					}, 940);
				});
			},
			//【--'page1'至'page6'--读取翻屏时动画】，若要新加，需要添加js语法；单数屏以page5为基础，双数屏以page6为基础，$（.***）都需要改成相应页数
			//注：------首页内每一屏，文字动效都是独立毁掉效果【兼容问题】；第一屏【ts1a、ts1b】；第二屏【ts2a、ts2b】…以此例推------
			//以下预写了20屏入画效果
			afterLoad: function(anchorLink, index) {
				if (index == 1 ) {
					$('.dn_lding').fadeIn(200);
					$('.sp1 .top_Atah').fadeIn(1100);
					$('.ts1a em').fadeIn(1100);
					$('.ts1b p').fadeIn(1100);
					$('.sp1').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 760);
					});
					$('.ts1a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts1b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 2 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts2a em').fadeIn(1100);
					$('.ts2b p').fadeIn(1100);
					$('.ts2a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts2b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 3 ) {
					$('.sp3 .top_Logo').fadeIn(1100);
					$('.dn_lding').fadeIn(200);
					$('.ts3a em').fadeIn(1100);
					$('.ts3b p').fadeIn(1100);
					$('.sp3').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 760);
					});
					$('.ts3a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts3b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 4 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts4a em').fadeIn(1100);
					$('.ts4b p').fadeIn(1100);
					$('.ts4a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts4b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 5 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts5a em').fadeIn(1100);
					$('.ts5b p').fadeIn(1100);
					$('.ts5a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts5b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 6 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts6a em').fadeIn(1100);
					$('.ts6b p').fadeIn(1100);
					$('.ts6a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts6b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 7 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts7a em').fadeIn(1100);
					$('.ts7b p').fadeIn(1100);
					$('.ts7a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts7b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 8 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts8a em').fadeIn(1100);
					$('.ts8b p').fadeIn(1100);
					$('.ts8a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts8b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 9 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts9a em').fadeIn(1100);
					$('.ts9b p').fadeIn(1100);
					$('.ts9a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts9b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 10 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts10a em').fadeIn(1100);
					$('.ts10b p').fadeIn(1100);
					$('.ts10a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts10b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 11 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts11a em').fadeIn(1100);
					$('.ts11b p').fadeIn(1100);
					$('.ts11a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts11b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 12 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts12a em').fadeIn(1100);
					$('.ts12b p').fadeIn(1100);
					$('.ts12a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts12b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 13 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts13a em').fadeIn(1100);
					$('.ts13b p').fadeIn(1100);
					$('.ts13a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts13b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 14 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts14a em').fadeIn(1100);
					$('.ts14b p').fadeIn(1100);
					$('.ts14a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts14b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 15 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts15a em').fadeIn(1100);
					$('.ts15b p').fadeIn(1100);
					$('.ts15a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts15b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 16 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts16a em').fadeIn(1100);
					$('.ts16b p').fadeIn(1100);
					$('.ts16a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts16b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 17 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts17a em').fadeIn(1100);
					$('.ts17b p').fadeIn(1100);
					$('.ts17a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts17b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 18 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts18a em').fadeIn(1100);
					$('.ts18b p').fadeIn(1100);
					$('.ts18a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts18b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 19 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts19a em').fadeIn(1100);
					$('.ts19b p').fadeIn(1100);
					$('.ts19a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts19b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
				if (index == 20 ) {
					$('.dn_lding').fadeIn(200);
					$('.ts20a em').fadeIn(1100);
					$('.ts20b p').fadeIn(1100);
					$('.ts20a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
						}, 890);
					});
				  $('.ts20b').each(function() {
					  var $rel = $(this).attr('rel');
					  var $arr = $rel.split(',');
					  $(this).animate({
						    left: $arr[2] + 'px',
//							top: $arr[3] + 'px'
					  }, 940);
				  });
				}
			},
			//【--'page1'至'page6'--释放翻屏后动画】，若要新加，需要添加js语法；单数屏以page5为基础，双数屏以page6为基础，$（.***）都需要改成相应页数
			//注：------首页内每一屏，文字动效都是独立毁掉效果【兼容问题】；第一屏【ts1a、ts1b】；第二屏【ts2a、ts2b】…以此例推------
			//以下预写了20屏出画效果
			onLeave: function(index, direction) {
				if (index == 1 ) {
					$('.dn_lding').fadeOut(200);
					$('.sp1 .top_Atah').fadeOut(1100);
					$('.ts1a em').fadeOut(1100);
					$('.ts1b p').fadeOut(1100);
					$('.sp1').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 450);
					});
					$('.ts1a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts1b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({

							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 2 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts2a em').fadeOut(1100);
					$('.ts2b p').fadeOut(1100);
					$('.ts2a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts2b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 3 ) {
					$('.sp3 .top_Logo').fadeOut(1100);
					$('.dn_lding').fadeOut(200);
					$('.ts3a em').fadeOut(1100);
					$('.ts3b p').fadeOut(1100);
					$('.sp3').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 450);
					});
					$('.ts3a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts3b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 4 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts4a em').fadeOut(1100);
					$('.ts4b p').fadeOut(1100);
					$('.ts4a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts4b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({

							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 5 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts5a em').fadeOut(1100);
					$('.ts5b p').fadeOut(1100);
					$('.ts5a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts5b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 6 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts6a em').fadeOut(1100);
					$('.ts6b p').fadeOut(1100);
					$('.ts6a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts6b').each(function() {
						var $rel = $(this).attr('rel');

						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 7 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts7a em').fadeOut(1100);
					$('.ts7b p').fadeOut(1100);
					$('.ts7a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts7b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 8 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts8a em').fadeOut(1100);
					$('.ts8b p').fadeOut(1100);
					$('.ts8a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts8b').each(function() {
						var $rel = $(this).attr('rel');

						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 9 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts9a em').fadeOut(1100);
					$('.ts9b p').fadeOut(1100);
					$('.ts9a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts9b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 10 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts10a em').fadeOut(1100);
					$('.ts10b p').fadeOut(1100);
					$('.ts10a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts10b').each(function() {
						var $rel = $(this).attr('rel');

						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 11 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts11a em').fadeOut(1100);
					$('.ts11b p').fadeOut(1100);
					$('.ts11a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts11b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 12 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts12a em').fadeOut(1100);
					$('.ts12b p').fadeOut(1100);
					$('.ts12a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts12b').each(function() {
						var $rel = $(this).attr('rel');

						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 13 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts13a em').fadeOut(1100);
					$('.ts13b p').fadeOut(1100);
					$('.ts13a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts13b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 14 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts14a em').fadeOut(1100);
					$('.ts14b p').fadeOut(1100);
					$('.ts14a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts14b').each(function() {
						var $rel = $(this).attr('rel');

						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 15 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts15a em').fadeOut(1100);
					$('.ts15b p').fadeOut(1100);
					$('.ts15a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts15b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 16 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts16a em').fadeOut(1100);
					$('.ts16b p').fadeOut(1100);
					$('.ts16a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts16b').each(function() {
						var $rel = $(this).attr('rel');

						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 17 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts17a em').fadeOut(1100);
					$('.ts17b p').fadeOut(1100);
					$('.ts17a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts17b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 18 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts18a em').fadeOut(1100);
					$('.ts18b p').fadeOut(1100);
					$('.ts18a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts18b').each(function() {
						var $rel = $(this).attr('rel');

						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 19 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts19a em').fadeOut(1100);
					$('.ts19b p').fadeOut(1100);
					$('.ts19a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts19b').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
				if (index == 20 ) {
					$('.dn_lding').fadeOut(200);
					$('.ts20a em').fadeOut(1100);
					$('.ts20b p').fadeOut(1100);
					$('.ts20a').each(function() {
						var $rel = $(this).attr('rel');
						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 500);
					});
					$('.ts20b').each(function() {
						var $rel = $(this).attr('rel');

						var $arr = $rel.split(',');
						$(this).animate({
							left: $arr[0] + 'px',
//							top: $arr[1] + 'px'
						}, 550);
					});
				}
			}
		});
	});

