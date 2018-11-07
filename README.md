# ROLIST
Radiation Oncology List. An open source EMR system dedicated to the small sized radiation oncology department

![스크린샷](https://github.com/beanaaa/ROLIST/blob/master/SC_%202018-11-06%2018.59.07.png)

## 소개
ROLIST는 방사선 종양학과에서 근무하면서 스케쥴링의 자동화, 치료기록의 저장등을 목적으로 자체 제작한 미니 EMR 시스템 입니다. 아래 페이지로 로그인 하여 새로운 가상의 환자를 등록해 테스트 해 보세요 :)

취미삼아 만들었기 때문에 보안에 취약할 수 있습니다. 반드시 인트라넷 웹서버를 구축한 후 사용해야 합니다. 샘플 사이트에 실제 환자 정보를 입력할 수 없습니다. :|

버그 리포팅이나 문의는 아래 카카오톡 오픈챗을 이용해 주세요(사실 멋있어 보여서 달아뒀는데 그냥 이메일로..... :)



 - sample site: http://ec2-54-88-165-135.compute-1.amazonaws.com
 - id/pass: guest/guest
 - 카카오톡 오픈챗: https://open.kakao.com/o/gkyrLG3
 - Mail: hanbean.youn@gmail.com
 
## 사용법
 - 신환등록: 우상단 New-Patient 버튼 또는 왼쪽 연필 아이콘 클릭후 원하느 환자 아이디를 입력한다. 환자 아이디는 숫자 형태만 지원
 - 정보입력: 신환을 등록한 후 자세한 정보를 입력한다. 외쪽 초록색 아이콘중 Add schedule 버튼을 클릭하여 치료일정을 추가한다. 
 - 스케쥴 계산: 처방선량/횟수를 입력하고 시뮬레이션/치료시작 날짜를 지정하고 우상단 체크 버튼을 클릭하면 주말/공휴일을 고려하여 스케쥴이 자동 계산된다.
 - 오더/노트: Short order와 Remark에서 + 버튼을 클릭하여 간단한 오더나 노트를 기록한다. 기록후 항상 체크버튼을 클릭해야 업데이트가 완료된다.
 - 진행상황: 각 페이지으 T, P, A 체크박스는 각각 Target delineation, RTPlan, Apporved를 의미한다. 각 과정이 완료되면 해당 체크박스를 선택하고 좌상단 체크 버튼을 클릭하면 업데이트 되며 상황에 맞게 리스트의 순서가 조절된다. RTP 페이지와 연동하여 확인 해 보자.
 - 치료중 환자의 일정이 변경될 경우 Nurse 페이지에서 환자를 선택하고 해당 스케쥴에서 Delay 버튼을 클릭하거나 환자벼 일정관리 페이지를 사용해 보자.
 - 자세한 내용은 Wiki를 참고 해 주세요. http://ec2-54-88-165-135.compute-1.amazonaws.com/wiki/doku.php
 
 
 ## 참고
 - HTML, MariaDB, PHP, Javascript등등을 구글링 하여 만들었습니다 :)
 - 혼자 만들다보니 여기저기 지저분한곳들이 있습니다. :(
 - 가장 저렴한 AWS 서버를 쓰다보니 속도가 느려요. 좋은 서버 쓰면 빨라집니다 :(
 - 논문이 될지 모르겠지만 관련내용으로 한편 적어보려 하는데 손에 잘 안잡힙니다 :(
 - 자동화 관련 부가기능등은 추후 업데이트 예정 :|
 - 소스코드를 먼저 올려야 하나, 수요가 얼마나 있나 일단 간보기 중입니다 :)

