# ROLIST
Radiation Oncology List. An open source EMR system dedicated to the small sized radiation oncology department

## 소개
ROLIST는 방사선 종양학과에서 근무하면서 스케쥴링의 자동화, 치료기록의 저장등을 목적으로 자체 제작한 미니 EMR 시스템 입니다. 아래 페이지로 로그인 하여 새로운 가상의 환자를 등록해 테스트 해 보세요 :)

취미삼아 만들었기 때문에 보안에 취약할 수 있습니다. 반드시 인트라넷 웹서버를 구축한 후 사용해야 합니다. 샘플 사이트에 실제 환자 정보를 입력할 수 없습니다.

버그 리포팅이나 문의는 아래 카카오톡 오픈챗을 이용해 주세요 :)

HTML, MariaDB, PHP, Javascript등등을 구글링 하여 만들었습니다ㅋㅋ


 - sample site: http://ec2-54-88-165-135.compute-1.amazonaws.com
 - id/pass: guest/guest
 - 카카오톡 오픈챗: https://open.kakao.com/o/gkyrLG3
 
## 사용법
 - 신환등록: 우상단 New-Patient 버튼 또는 왼쪽 연필 아이콘 클릭후 원하느 환자 아이디를 입력한다. 환자 아이디는 숫자 형태만 지원
 - 정보입력: 신환을 등록한 후 자세한 정보를 입력한다. 외쪽 초록색 아이콘중 Add schedule 버튼을 클릭하여 치료일정을 추가한다. 
 - 스케쥴 계산: 처방선량/횟수를 입력하고 시뮬레이션/치료시작 날짜를 지정하고 우상단 체크 버튼을 클릭하면 주말/공휴일을 고려하여 스케쥴이 자동 계산된다.
 - 오더/노트: Short order와 Remark에서 + 버튼을 클릭하여 간단한 오더나 노트를 기록한다. 기록후 항상 체크버튼을 클릭해야 업데이트가 완료된다.
 - 진행상황: 각 페이지으 T, P, A 체크박스는 각각 Target delineation, RTPlan, Apporved를 의미한다. 각 과정이 완료되면 해당 체크박스를 선택하고 좌상단 체크 버튼을 클릭하면 업데이트 된다. 각 상황에 맞게 리스트의 순서가 조절된다. RTP 페이지와 연동하여 확인 해 보자.

