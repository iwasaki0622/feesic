	<!-- container to normalize fixed navigation behavior when scrolling -->
	<div class="navcontain">
		<div class="pretty navbar" gumby-fixed="top" id="nav3">
			<div class="row">
				<a class="toggle" gumby-trigger="#nav3 > .row > ul" href="#"><i class="icon-menu"></i></a>
				<h1 class="four columns logo">
					<a href="/">
						<?php echo Asset::img("feesic.png"); ?>
					</a>
				</h1>
				<ul class="eight columns">
					<li><a href="#">HOME</a></li>
					<li>
						<a href="#">Mypage</a>
					</li>
					<li><a href="#">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="row">
		<h1 class="lead">feesic 〜あの子を聴こう〜</h1>
        <p>
            feesicとは、「Feel」と「Music」を合わせた言葉です。<br />
            言葉では伝えづらいこと、伝わりづらいこと。<br />
            <br />
            その想い、音楽で届けられたら素敵だと思いませんか？
        </p>
        
        <div class="row">
            <h2>Userさんの想い</h2>
            <div class="row">
                <div class="twelve columns">
                    <div class="row">
                        <div class="three columns image circle">
						<?php echo Asset::img("user001.jpg"); ?>
                        </div>
                        <div class="five columns">
                            <h4 class="lead">リード</h4>
                            <ul class="square">
                                <li>今の想い</li>
                                <li>List item</li>
                                <li>List item</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
		<div class="row">
            <h2>Userさんの想い</h2>
            <div id="youtube"></div>
		</div>
	</div>