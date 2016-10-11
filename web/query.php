<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>技术资讯开放平台</title>
		<script src="//cdn.bootcss.com/jquery/3.1.0/jquery.js"></script>
		<link rel="stylesheet" href="css/weui.min.css" />
		<link rel="stylesheet" href="css/main.css" />
		<style type="text/css">
			#bottom_space {
				height: 80px;
			}
		</style>
	</head>

	<body ontouchstart>
        <?php
            error_reporting(E_ALL);
            ini_set( 'display_errors', 'On' );
        ?>
		<div class="page">
			<div class="hd">
				<h1 class="page_title">技术资讯开放平台</h1>
				<p class="page_desc">聚焦最新Android资讯(搜索专区)</p>
			</div>
			<div class="bd">
				<div class="weui-search-bar" id="searchBar">
					        <form class="weui-search-bar__form">
					            <div class="weui-search-bar__box">
					                <i class="weui-icon-search"></i>
					                <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required/>
					                <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
					            </div>
					            <label class="weui-search-bar__label" id="searchText">
					                <i class="weui-icon-search"></i>
					                <span>搜索</span>
					            </label>
					        </form>
					        <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
					    </div>
				   </div>

				   <div id="search_result_container" class="weui-panel weui-panel_access">
					<div class="weui-panel__hd">搜索結果</div>
					<div class="weui-panel__bd" id="search_result_list">
				</div>
			</div>
			
			<?php
				include("footer.php");
			?>
		<script type="text/javascript">
			$(document).ready(function() {
	            $("form").submit(function() {
	            	var params = {
	            		query: $('#searchInput').val()
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
								resultHtml += "<a href=\"" + msg[seachResultItem].link + "\" target=\"_blank\" class=\"weui-media-box weui-media-box_appmsg\">";
								resultHtml += "<div class=\"weui-media_bd\">";
								resultHtml += "<h4 class=\"weui-media-box__title\">" + msg[seachResultItem].title +"</h4>";
								resultHtml += "<p class=\"weui-media-box__desc\">" + msg[seachResultItem].summary + "</p>";
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

    $(function(){

        var $searchBar = $('#searchBar'),

            $searchResult = $('#searchResult'),

            $searchText = $('#searchText'),

            $searchInput = $('#searchInput'),

            $searchClear = $('#searchClear'),

            $searchCancel = $('#searchCancel');



        function hideSearchResult(){

            $searchResult.hide();

            $searchInput.val('');

        }

        function cancelSearch(){

            hideSearchResult();

            $searchBar.removeClass('weui-search-bar_focusing');

            $searchText.show();

        }



        $searchText.on('click', function(){

            $searchBar.addClass('weui-search-bar_focusing');

            $searchInput.focus();

        });

        $searchInput

            .on('blur', function () {

                if(!this.value.length) cancelSearch();

            })

            .on('input', function(){

                if(this.value.length) {

                    $searchResult.show();

                } else {

                    $searchResult.hide();

                }

            })

        ;

        $searchClear.on('click', function(){

            hideSearchResult();

            $searchInput.focus();

        });

        $searchCancel.on('click', function(){

            cancelSearch();

            $searchInput.blur();

        });

    });

</script>
	</body>
</html>
