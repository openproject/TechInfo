<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>Android技术资讯开放平台</title>
		<script src="//cdn.bootcss.com/jquery/3.1.0/jquery.js"></script>
		<link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/1.0.0/weui.min.css" />
		<link rel="stylesheet" href="css/main.css" />
		<style type="text/css">
			.tab_hide {
				display: none;
			}
			#bottom_space {
				height: 80px;
			}
			.source_tag {
				color: #888;
				font-size: 8px;
				margin-right: 4px;
				padding: 4px;
				border: 1px solid #DA574B;
				background-color: #DA574B;
            }
		</style>
	</head>

	<body ontouchstart>
        <?php
            error_reporting(E_ALL);
            ini_set( 'display_errors', 'On' );
        ?>
		<?php
            require_once 'common/Utils.php';
            $utils = new Utils();

            $mysql_server_name='localhost'; //改成自己的mysql数据库服务器
			$mysql_username='root'; //改成自己的mysql数据库用户名
			$mysql_password='<db_password>'; //改成自己的mysql数据库密码
			$mysql_database='TechInfo'; //改成自己的mysql数据库名

			$conn=@mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //连接数据库

			mysql_query("set names 'utf8'"); //数据库输出编码 应该与你的数据库编码保持一致.南昌网站建设公司百恒网络PHP工程师建议用UTF-8 国际标准编码.

			mysql_select_db($mysql_database); //打开数据库

			$today = date("Y-m-d",time());
			$last_time = "不知道";

			$sql ="select * from config where name = 'last_time'"; //SQL语句
			$result = mysql_query($sql,$conn); //查询
			while($row = mysql_fetch_array($result)) {
				$last_time = $row["val"];
			}
		?>
		<div class="weui-tab_bd">
			<div class="hd">
				<h1 class="page_title">技术资讯开放平台</h1>
				<p class="page_desc">聚焦最新Android资讯(更新于<?php echo $last_time ?>)</p>
			</div>

			<div class="weui-tab">
				<div id="tab_home">
					<div id="home_android_container" class="weui-panel weui-panel_access tab_hide">
						<div class="weui-panel__hd">今日推荐(
							<?php
								echo date("Y-m-d",time());
							?>
							)</div>
						<div class="weui-panel__bd">
							<?php
								$sql ="select * from feed where time = '" . $today . "' and priority=1 and (tag like '%Android%' or tag like '%Java%') order by id desc"; //SQL语句
								$result = mysql_query($sql,$conn); //查询
								while($row = mysql_fetch_array($result))
								{
									if (empty($row["title"])) {
										continue;
									}
									echo "<a href=\"" . $row["link"] . "\" target=\"_blank\" class=\"weui-media-box weui-media-box_appmsg\">";
									echo "<div class=\"weui-media__bd\">";
									echo "<h4 class=\"weui-media__title\">" . $row["title"] ."</h4>";
									echo "<p class=\"weui-media__desc\">" . $row["summary"] . "</p>";
                                    echo "<ul class=\"weui-media__info\">";
                                    echo "    <li class=\"weui-media__info__meta\">" . $utils->getWellTimeByTimestamp($row["created"]) ."</li>";
                                    echo "    <li class=\"weui-media__info__meta weui-media__info__meta_extra\">" . $row["source"]. "</li>";
                                    echo "</ul>";
					echo "</div>";
									echo "</a>\n";
								}
							?>
						</div>
						<div class="weui-panel__ft">
							<a class="weui-cell weui-cell_access weui-cell_link" href="list.php" target="_blank">查看更多</a>
						</div>
					</div>

					<div id="home_android_container" class="weui-panel weui-panel_access">
						<div class="weui-panel__hd">仅供参考(
							<?php
								echo date("Y-m-d",time());
							?>
							)</div>
						<div class="weui-panel__bd">
							<?php
								$sql ="select * from feed where time = '" . $today . "' and priority>1 and (tag like '%Android%' or tag like '%Java%') order by id desc"; //SQL语句
								$result = mysql_query($sql,$conn); //查询
								while($row = mysql_fetch_array($result))
								{
									if (empty($row["title"])) {
										continue;
									}
									echo "<a href=\"" . $row["link"] . "\" target=\"_blank\" class=\"weui-media-box weui-media-box_appmsg\">";
									echo "<div class=\"weui-media__bd\">";
									echo "<h4 class=\"weui-media__title\">" . $row["title"] ."</h4>";
									echo "<p class=\"weui-media__desc\">" . $row["summary"] . "</p>";
                                    echo "<ul class=\"weui-media__info\">";
                                    echo "    <li class=\"weui-media__info__meta\">" . $utils->getWellTimeByTimestamp($row["created"]) ."</li>";
                                    echo "    <li class=\"weui-media__info__meta weui-media__info__meta_extra\">" . $row["source"]. "</li>";
                                    echo "</ul>";
					echo "</div>";
									echo "</a>\n";
								}
							?>
						</div>
                    </div>
<br />
<br />
<br />
                    <div class="weui-footer">
                        <p class="weui-footer__links">
                            <a href="http://www.jayfeng.com" class="weui-footer__link">杰风居出品</a>
                            <a href="javascript:void(0);" class="weui-footer__link">Github</a>
                        </p>
                        <p class="weui-footer__text">Copyright &copy; 20015-2016 jayfeng.com</p>
                    </div>
				</div>


				<div id="tab_tools" class="tab_hide">
					<div class="weui_panel weui_panel_access">
					    <div class="weui_panel_hd">种子源</div>
					    <div class="weui_panel_bd">
					        <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
					            <div class="weui_media_hd">
					                <img class="weui_media_appmsg_thumb" src="http://www.atool.org/placeholder.png?size=120x120&text=干&&bg=AB3F49&fg=fff" alt="">
					            </div>
					            <div class="weui_media_bd">
					                <h4 class="weui_media_title">干货集中营</h4>
					                <p class="weui_media_desc">每日分享妹子图 和 技术干货，还有供大家中午休息的休闲视频</p>
					            </div>
					        </a>
					        <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
					            <div class="weui_media_hd">
					                <img class="weui_media_appmsg_thumb" src="http://www.atool.org/placeholder.png?size=120x120&text=头&&bg=AB3F49&fg=fff" alt="">
					            </div>
					            <div class="weui_media_bd">
					                <h4 class="weui_media_title">开发者头条</h4>
					                <p class="weui_media_desc">在开发者头条，你可以阅读头条新闻、分享技术文章、发布开源项目，订阅技术极客/技术团队开通的独家号/团队号和关注编程牛人。</p>
					            </div>
					        </a>
					    </div>
					    <a class="weui_panel_ft" href="javascript:void(0);">查看更多</a>
					</div>

					<div class="weui_panel weui_panel_access">
					    <div class="weui_panel_hd">精品资源</div>
					    <div class="weui_panel_bd">
					    	<a href="https://github.com/amfe/article/issues/17" target="_blank" class="weui_media_box weui_media_appmsg">
					            <div class="weui_media_bd">
					                <h4 class="weui_media_title">使用Flexible实现手淘H5页面的终端适配</h4>
					                <p class="weui_media_desc">趁此Amfe阿里无线前端团队双11技术连载之际，用一个实战案例来告诉大家，手淘的H5页面是如何实现多终端适配的，希望这篇文章对大家在Mobile的世界中能过得更轻松。</p>
					            </div>
					       </a>
					       <a href="http://mp.weixin.qq.com/s?__biz=MjM5NTg5NTI2Ng==&mid=2651947064&idx=1&sn=f338b14ba2cc7fb0d0144ee33efdda97&scene=0#wechat_redirect" target="_blank" class="weui_media_box weui_media_appmsg">
					            <div class="weui_media_bd">
					                <h4 class="weui_media_title">HTTP 协议入门</h4>
					                <p class="weui_media_desc">HTTP 协议是互联网的基础协议，也是网页开发的必备知识，最新版本 HTTP/2 更是让它成为技术热点。本文介绍 HTTP 协议的历史演变和设计思路。</p>
					            </div>
					       </a>
						   <a href="http://design.google.com/resizer" target="_blank" class="weui_media_box weui_media_appmsg">
					            <div class="weui_media_bd">
					                <h4 class="weui_media_title">Resizer - Google Design</h4>
					                <p class="weui_media_desc">An interactive viewer to see and test how digital products respond to material design breakpoints across desktop, mobile and tablet.</p>
					            </div>
					       </a>
						   <a href="http://www.cnblogs.com/chyingp/p/https-introduction.html" target="_blank" class="weui_media_box weui_media_appmsg">
					            <div class="weui_media_bd">
					                <h4 class="weui_media_title">HTTPS科普扫盲帖</h4>
					                <p class="weui_media_desc">为什么需要https？HTTPS是如何保障安全的？HTTPS是如何加密数据的...</p>
					            </div>
					       </a>
						   <a href="https://inthecheesefactory.com/blog/fragment-state-saving-best-practices/" target="_blank" class="weui_media_box weui_media_appmsg">
					            <div class="weui_media_bd">
					                <h4 class="weui_media_title">The Real Best Practices to Save/Restore Activity's and Fragment's state. </h4>
					                <p class="weui_media_desc">StatedFragment is now deprecated...</p>
					            </div>
					       </a>
					    </div>
					    <a href="javascript:void(0);" class="weui_panel_ft">查看更多</a>
					</div>
				</div>



				<div id="tab_favoriate" class="tab_hide">
					<div class="bd">
						<div class="weui_search_bar" id="search_bar">
					        <form class="weui_search_outer">
					            <div class="weui_search_inner">
					                <i class="weui_icon_search"></i>
					                <input type="search" class="weui_search_input" id="search_input" placeholder="搜索" required/>
					                <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
					            </div>
					            <label for="search_input" class="weui_search_text" id="search_text">
					                <i class="weui_icon_search"></i>
					                <span>搜索</span>
					            </label>
					        </form>
					        <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
					    </div>
					    <div class="weui_cells weui_cells_access search_show" id="search_show">
					    </div>
				   </div>

				   <div id="search_result_container" class="weui_panel weui_panel_access">
						<div class="weui_panel_hd">搜索結果</div>
						<div class="weui_panel_bd" id="search_result_list">
						</div>
					</div>
				</div>



				<div id="tab_setting" class="tab_hide">
					<div class="weui_cells_title">帐号</div>
				    <div class="weui_cells">
				        <div class="weui_cell weui_cell_select weui_select_after">
				            <div class="weui_cell_hd">
				                <label for="" class="weui_label">内置列表</label>
				            </div>
				            <div class="weui_cell_bd weui_cell_primary">
				                <select class="weui_select" name="select2">
				                	<option value="3">仅本地</option>
				                    <option value="3">jingtian@lez.cn</option>
				                    <option value="3">renxiangdong@lez.cn</option>
				                    <option value="1">fengjian@lez.cn</option>
				                    <option value="2">zhangyong@lez.cn</option>
				                </select>
				            </div>
				        </div>
				    </div>

					<div class="weui_cells_title">首页频道</div>
				    <div class="weui_cells weui_cells_checkbox">
				        <label class="weui_cell weui_check_label" for="cb_android">
				            <div class="weui_cell_hd">
				                <input type="checkbox" class="weui_check" name="checkbox_android" id="cb_android" checked="checked">
				                <i class="weui_icon_checked"></i>
				            </div>
				            <div class="weui_cell_bd weui_cell_primary">
				                <p>Android</p>
				            </div>
				        </label>
				        <label class="weui_cell weui_check_label" for="cb_ios">
				            <div class="weui_cell_hd">
				                <input type="checkbox" name="checkbox_ios" class="weui_check" id="cb_ios" checked="checked">
				                <i class="weui_icon_checked"></i>
				            </div>
				            <div class="weui_cell_bd weui_cell_primary">
				                <p>iOS</p>
				            </div>

				        </label>
				        <label class="weui_cell weui_check_label" for="cb_server">
				            <div class="weui_cell_hd">
				                <input type="checkbox" name="checkbox_server" class="weui_check" id="cb_server" checked="checked">
				                <i class="weui_icon_checked"></i>
				            </div>
				            <div class="weui_cell_bd weui_cell_primary">
				                <p>后端、H5</p>
				            </div>

				        </label>
				        <label class="weui_cell weui_check_label" for="cb_ui">
				            <div class="weui_cell_hd">
				                <input type="checkbox" name="checkbox_ui" class="weui_check" id="cb_ui" checked="checked">
				                <i class="weui_icon_checked"></i>
				            </div>
				            <div class="weui_cell_bd weui_cell_primary">
				                <p>设计</p>
				            </div>

				        </label>
				        <label class="weui_cell weui_check_label" for="cb_operation">
				            <div class="weui_cell_hd">
				                <input type="checkbox" name="checkbox_operation" class="weui_check" id="cb_operation" checked="checked">
				                <i class="weui_icon_checked"></i>
				            </div>
				            <div class="weui_cell_bd weui_cell_primary">
				                <p>运维、底层</p>
				            </div>

				        </label>
				        <label class="weui_cell weui_check_label" for="cb_else">
				            <div class="weui_cell_hd">
				                <input type="checkbox" name="checkbox_else" class="weui_check" id="cb_else" checked="checked">
				                <i class="weui_icon_checked"></i>
				            </div>
				            <div class="weui_cell_bd weui_cell_primary">
				                <p>其它</p>
				            </div>

				        </label>
				    </div>
				    <div class="weui_btn_area">
				        <a class="weui_btn weui_btn_primary" href="javascript:" id="showTooltips">从服务器更新</a>
				    </div>
				    <div class="weui_btn_area">
				        <a class="weui_btn weui_btn_warn" href="javascript:" id="showTooltips">更新到服务器</a>
				    </div>
				</div>

				<div id="bottom_space">
				</div>
			</div>
			<div class="weui-tabbar tab_hide">
				<a href="javascript:switchTab('home');" class="weui-tabbar__item weui_bar_item_on">
					<div class="weui-tabbar__icon">
						<img src="img/icon_nav_home.png" alt="">
					</div>
					<p class="weui-tabbar__label">首页</p>
				</a>
				<a href="javascript:switchTab('favorite');" class="weui-tabbar__item">
					<div class="weui-tabbar__icon">
						<img src="img/icon_nav_search.png" alt="">
					</div>
					<p class="weui-tabbar__label">搜索</p>
				</a>
				<a href="javascript:switchTab('tools');" class="weui-tabbar__item">
					<div class="weui-tabbar__icon">
						<img src="img/icon_nav_tools.png" alt="">
					</div>
					<p class="weui_tabbar_label">工具箱</p>
				</a>
				<a href="javascript:switchTab('setting');" class="weui-tabbar__item">
					<div class="weui-tabbar__icon">
						<img src="img/icon_nav_setting.png" alt="">
					</div>
					<p class="weui-tabbar__label">设置</p>
				</a>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				// 本地状态
				if (localStorage["cb_android"] != 0) {
					$("#home_android_container").removeClass("tab_hide");
				} else {
					$("#cb_android").click();
				}
				if (localStorage["cb_ios"] != 0) {
					$("#home_ios_container").removeClass("tab_hide");
				} else {
					$("#cb_ios").click();
				}

				if (localStorage["cb_server"] != 0) {
					$("#home_server_container").removeClass("tab_hide");
				} else {
					$("#cb_server").click();
				}
				if (localStorage["cb_ui"] != 0) {
					$("#home_ui_container").removeClass("tab_hide");
				} else {
					$("#cb_ui").click();
				}
				if (localStorage["cb_else"] != 0) {
					$("#home_else_container").removeClass("tab_hide");
				} else {
					$("#cb_else").click();
				}

				$(".page_title").click(function() {
					if($(".weui_tabbar").css("display") == "none") {
						$(".weui_tabbar").removeClass("tab_hide");
					} else {
						$(".weui_tabbar").addClass("tab_hide");
					}
				});

				$("#cb_android, #cb_ios, #cb_server, #cb_ui, #cb_operation, #cb_else").change(function() {
					if ($(this).prop("checked")) {
						localStorage[$(this).attr("id")] = 1;
					} else {
						localStorage[$(this).attr("id")] = 0;
					}
				});

				$('#tab_favoriate').on('focus', '#search_input', function () {
	                var $weuiSearchBar = $('#search_bar');
	                $weuiSearchBar.addClass('weui_search_focusing');
	            }).on('blur', '#search_input', function () {
	                var $weuiSearchBar = $('#search_bar');
	                $weuiSearchBar.removeClass('weui_search_focusing');
	                if ($(this).val()) {
	                    $('#search_text').hide();
	                } else {
	                    $('#search_text').show();
	                }
	            }).on('input', '#search_input', function () {
	                var $searchShow = $("#search_show");
	                if ($(this).val()) {
	                    $searchShow.show();
	                } else {
	                    $searchShow.hide();
	                }
	            }).on('touchend', '#search_cancel', function () {
	                $("#search_show").hide();
	                $('#search_input').val('');
	            }).on('touchend', '#search_clear', function () {
	                $("#search_show").hide();
	                $('#search_input').val('');
	            });

	            $("form").submit(function() {
	            	var params = {
	            		query: $('#search_input').val()
	            	};
					$.ajax({
						type: "post",
						url: "search.php",
						dataType: "json",
						data: params,
						success: function(msg){
							$("#search_result_list").html('');
				            var resultHtml = "";
							for(var seachResultItem in msg) {
								resultHtml += "<a href=\"" + msg[seachResultItem].link + "\" target=\"_blank\" class=\"weui_media_box weui_media_appmsg\">";
								resultHtml += "<div class=\"weui_media_hd\">";
				                resultHtml += "<img class=\"weui_media_appmsg_thumb\" src=\"http://www.atool.org/placeholder.png?size=120x120&text=" + msg[seachResultItem].source + "&&bg=479436&fg=fff\">";
				                resultHtml += "</div>";
				                resultHtml += "<div class=\"weui_media_bd\">";
				                resultHtml += "<h4 class=\"weui_media_title\">" + msg[seachResultItem].title +"</h4>";
				                resultHtml += "<p class=\"weui_media_desc\">" + msg[seachResultItem].summary + "</p>";
				                resultHtml += "</div>";
				            	resultHtml += "</a>";
							}

							$("#search_result_list").html(resultHtml);
						}
					});
	            	return false;
	            });
			});
		</script>
		<script type="text/javascript">
			function switchTab(tab) {
				if(tab == "home") {
					$("#tab_home").removeClass("tab_hide")
					$("#tab_tools").addClass("tab_hide")
					$("#tab_favoriate").addClass("tab_hide")
					$("#tab_setting").addClass("tab_hide")
				} else if(tab == "tools") {
					$("#tab_home").addClass("tab_hide")
					$("#tab_tools").removeClass("tab_hide")
					$("#tab_favoriate").addClass("tab_hide")
					$("#tab_setting").addClass("tab_hide")
				} else if(tab == "favorite") {
					$("#tab_home").addClass("tab_hide")
					$("#tab_tools").addClass("tab_hide")
					$("#tab_favoriate").removeClass("tab_hide")
					$("#tab_setting").addClass("tab_hide")
				} else if(tab == "setting") {
					$("#tab_home").addClass("tab_hide")
					$("#tab_tools").addClass("tab_hide")
					$("#tab_favoriate").addClass("tab_hide")
					$("#tab_setting").removeClass("tab_hide")
				}
			}
		</script>
	</body>

</html>
