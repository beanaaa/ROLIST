<?php
// 세션을 시작합니다.
// 이후에 사용 할 로그인 용.
session_start();

// class를 이용한 객체 지향 방식
class Layout
{
	public $title="Need Programs"; // 웹 페이지 제목
	public $link; // CSS 링크 태그
	public $style; // 스타일 적용 
	public $content; // 메인 컨텐츠
	public $board; //게시판 이름 지정
	private $sub; // 서브 메뉴용 변수
	private $login; // 로그인이나 로그아웃을 출력
	
	// 레이아웃을 출력
	public function LayoutMain()
	{
		echo "<!DOCTYPE html>\n<html lang='ko'>";
		echo "<head>\n<meta charset='utf-8'/>";
		echo "<title>".$this->title."</title>";
		echo $this->LayoutStyle(); // 스타일을 레이아웃에 추가.
		echo "</head>\n<body>\n<div id='container'>";
		echo	$this->LayoutHeader(); // 헤더 부분을 레이아웃에 추가
		echo	$this->LayoutContent(); // 컨텐츠 부분을 레이아웃에 추가
		echo	$this->LayoutSide(); // 사이드 부분을 레이아웃에 추가
		echo	$this->LayoutFooter(); // 푸터 부분을 레이아웃에 추가
		echo "</div></body>\n</html>";
	}
	
	// 스타일을 추가
	public function LayoutStyle()
	{
		echo "<link rel='stylesheet' type='text/css' href='".$this->link."'/> ";
		echo "<style>".$this->style."</style>";
	}
	
	// 헤더 부분 추가
	public function LayoutHeader()
	{
		$this->LayoutLogin();
		echo "<header>
			<div id='logo'><h1><a href='./'>Need Programs</a></h1></div>
				<div id='navset'>
					<nav id='menu'><li><a href='./board/'>Board</a></li><li><a href='./programs/'>Programs</a></li><li><a href='./notice/'>Notice</a></li></nav>
					<nav id='login'>".$this->login."</nav>
				</div>
			<div class='ad_1'>
				//광고 영역
			</div>
		</header>";
	}
	
	// 로그인을 출력할 지 로그아웃을 출력할 지 결정
	public  function LayoutLogin()
	{
		if($_SESSION['id']=="")
		{
			$this->login="<a href='./login.php'>Login</a>";
		} else
		{
			$this->login="<a href='./logout.php'>Logout</a>";
		}
	}

	// 내용을 추가
	public function LayoutContent()
	{
		echo "<section><article>".$this->content."</article>";
	}
	// 사이드바 추가
	public function LayoutSide()
	{
		$this->board=explode('/', $_SERVER['PHP_SELF']);
		switch($this->board[1])
		{
			case setup : 
				$this->sub="@@@@만드는 중";
				break;
			default : 
				$this->sub="@@@사이드바 제작중";
		}
		echo "<aside>".$this->sub."</aside></section>";
	}
	
	// 푸터 부분 추가
		public function LayoutFooter()
	{
		echo "<footer>Copyright © Kurien. All rights reserved. Need Programs</footer>";
	}
}
?>