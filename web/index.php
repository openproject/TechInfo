<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>Android技术资讯开放平台</title>
		<script src="//cdn.bootcss.com/jquery/3.1.0/jquery.js"></script>
		<link rel="stylesheet" href="css/weui.min.css" />
		<link rel="stylesheet" href="css/main.css" />
		<style type="text/css">
			.tab_hide {
				display: none;
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
					<div id="home_android_container" class="weui-panel weui-panel_access">
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
									echo "<h4 class=\"weui-media-box__title\">" . $row["title"] ."</h4>";
									echo "<p class=\"weui-media-box__desc\">" . $row["summary"] . "</p>";
                                    echo "<ul class=\"weui-media-box__info\">";
                                    echo "    <li class=\"weui-media-box__info__meta\">" . $utils->getWellTimeByTimestamp($row["created"]) ."</li>";
                                    echo "    <li class=\"weui-media-box__info__meta weui-media-box__info__meta_extra\">" . $row["source"]. "</li>";
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

					<div id="home_android_2_container" class="weui-panel weui-panel_access">
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
									echo "<div class=\"weui-media-box__bd\">";
									echo "<h4 class=\"weui-media-box__title\">" . $row["title"] ."</h4>";
									echo "<p class=\"weui-media-box__desc\">" . $row["summary"] . "</p>";
                                    echo "<ul class=\"weui-media-box__info\">";
                                    echo "    <li class=\"weui-media-box__info__meta\">" . $utils->getWellTimeByTimestamp($row["created"]) ."</li>";
                                    echo "    <li class=\"weui-media-box__info__meta weui-media-box__info__meta_extra\">" . $row["source"]. "</li>";
                                    echo "</ul>";
					echo "</div>";
									echo "</a>\n";
								}
							?>
						</div>
                    </div>
			
			<?php
				include("footer.php");
			?>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
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
	</body>

</html>
