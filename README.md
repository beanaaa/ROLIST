# ROLIST
Radiation Oncology List. An open source EMR system dedicated to the small radiation oncology department

![스크린샷](https://github.com/beanaaa/ROLIST/blob/master/SC_%202018-11-06%2018.59.07.png)

## 소개
ROLIST는 방사선 종양학과에서 근무하면서 스케쥴링의 자동화, 치료기록의 저장등을 목적으로 자체 제작한 미니 EMR 시스템 입니다. 아래 페이지로 로그인 하여 새로운 가상의 환자를 등록해 테스트 해 보세요 :)

취미삼아 만들었기 때문에 보안에 취약할 수 있습니다. 반드시 인트라넷 웹서버를 구축한 후 사용해야 합니다. 샘플 사이트에 실제 환자 정보를 입력할 수 없습니다. :|

버그 리포팅이나 문의는 아래 카카오톡 오픈챗을 이용해 주세요(사실 멋있어 보여서 달아뒀는데 그냥 이메일로..... :)

Dedicated to Small RO Department인 이유는 CT 시뮬레이터를 한대만 지원하기 때문입니다. ㅎㅎㅎ



 - sample site: http://ec2-54-88-165-135.compute-1.amazonaws.com
 - id/pass: guest/guest
 - 카카오톡 오픈챗: https://open.kakao.com/o/gkyrLG3
 - Mail: hanbean.youn@gmail.com
 
업로드된 파일은 php7으로 마이그레이션 하고 있지만 샘플 사이트는 php5.6 기준입니다. 

## 주요기능
### Physician's Todo List
target delineation, plan approval등 Todolist 표시. 체크박스를 통해 RTP, 치료실, 접수등과 데이터 연동
![스크린샷](https://github.com/beanaaa/ROLIST/blob/master/SC_%202018-11-13%2009.12.57.png)
### Active, Scheduled, Unscheduled Patients
치료중이 환자, 시뮬레이션이 예정된 환자등의 리스트 표시 및 모니터링
![스크린샷](https://github.com/beanaaa/ROLIST/blob/master/SC_%202018-11-13%2009.13.08.png)
### RTP's Todo List
신환, RF 환자등 스케쥴별 Plan Todo list, 치료실, 접수등에서 Note된 환자 리스트를 Planner별, Physician별 표시
![스크린샷](https://github.com/beanaaa/ROLIST/blob/master/SC_%202018-11-13%2009.14.39.png)
### 자동 스케쥴링
시뮬레이션, 시작날짜 및 처방선량을 입력하면 RF를 포함하여 자동 스케쥴링. 휴일 및 주말 고려등등
![스크린샷](https://github.com/beanaaa/ROLIST/blob/master/SC_%202018-11-13%2009.16.53.png)
### Monthly Calendar
치료일정을 카테고리별로 분류하여 캘린더 형태로 표시
![스크린샷](https://github.com/beanaaa/ROLIST/blob/master/SC_%202018-11-13%2009.18.35.png)
### Advanced Search
빅데이터/딥러닝 연구등으 목적으로 입력된 케이스를 다양한 방법으로 정렬. MIM/Matlab/Java 플러그인을 이용해 RTdose, RTst등을 추출



## 사용법
 - 신환등록: 우상단 New-Patient 버튼 또는 왼쪽 연필 아이콘 클릭후 원하느 환자 아이디를 입력한다. 환자 아이디는 숫자 형태만 지원
 - 정보입력: 신환을 등록한 후 자세한 정보를 입력한다. 외쪽 초록색 아이콘중 Add schedule 버튼을 클릭하여 치료일정을 추가한다. 
 - 스케쥴 계산: 처방선량/횟수를 입력하고 시뮬레이션/치료시작 날짜를 지정하고 우상단 체크 버튼을 클릭하면 주말/공휴일을 고려하여 스케쥴이 자동 계산된다.
 - 오더/노트: Short order와 Remark에서 + 버튼을 클릭하여 간단한 오더나 노트를 기록한다. 기록후 항상 체크버튼을 클릭해야 업데이트가 완료된다.
 - 진행상황: 각 페이지으 T, P, A 체크박스는 각각 Target delineation, RTPlan, Apporved를 의미한다. 각 과정이 완료되면 해당 체크박스를 선택하고 좌상단 체크 버튼을 클릭하면 업데이트 되며 상황에 맞게 리스트의 순서가 조절된다. RTP 페이지와 연동하여 확인 해 보자.
 - 치료중 환자의 일정이 변경될 경우 Nurse 페이지에서 환자를 선택하고 해당 스케쥴에서 Delay 버튼을 클릭하거나 환자벼 일정관리 페이지를 사용해 보자.
 - 자세한 내용은 Wiki를 참고 해 주세요. http://ec2-54-88-165-135.compute-1.amazonaws.com/wiki/doku.php?id=wiki:welcome
 - 위키는 시간날때마다 조금씩 업데이트 할 계획입니다 :) 


 ## 참고
 - HTML, MariaDB, PHP, Javascript등등을 구글링 하여 만들었습니다 :)
 - 혼자 만들다보니 여기저기 지저분한곳들이 있습니다. :(
 - 가장 저렴한 AWS 서버를 쓰다보니 속도가 느려요. 좋은 서버 쓰면 빨라집니다 :(
 - 샘플 사이트는 속도가 빠른것도 같지만 그건 데이터가 많이 없어서 그렇습니다.
 - 업데이트된 PHP7.0 버전을 사용하면 30-50 퍼센트 빠릅니다.
 - 자동화 관련 부가기능등은 추후 업데이트 예정 :|
 - 몇몇 페이지에서 한글 인코딩 문제가 있습니다. :(
 - 설치 관련 내용은 위키에 아주 간단히 정리되어 있어요. :)
 - OSX 10.14, MAMP 조합을 테스트 완료. 앱등이라..윈도우는 없어서 테스트를 못해봤습니다....2018 맥미니 잘나왔...

