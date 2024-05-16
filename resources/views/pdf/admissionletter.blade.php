<!DOCTYPE html>
<html>
  <head>
    <title>
      ADDMISSION LETTER {{ !empty($candidateInfo->surname) ? $candidateInfo->surname :
      'null' }} {{ !empty($candidateInfo->firstname) ? $candidateInfo->firstname
      : 'null' }}
    </title>
    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;

        margin: 0;
        font-family: Georgia, serif;

        font-size: 14px;
      }

      .letter {
        width: 95%;
        padding: 20px;
        border: 1px solid black;
        border-radius: 10px;
        background-color: white;
        line-height: 1.4;
      }

      .address {
        text-align: left;
        margin-bottom: 20px;
      }

      .right {
        text-align: right;
        margin-bottom: 20px;
      }

      .matric-date {
        /*overflow: hidden;*/
        margin-bottom: 20px;
      }

      .matric {
        float: left;
      }

      .date {
        float: right;
      }

      .topic {
        text-decoration: underline;
        margin: 20px 0;
        font-weight: bold;
        text-align: center;
      }

      .body {
        margin-bottom: 20px;
      }

      .footer {
        overflow: hidden;
        margin-top: 20px;
      }

      .student {
        float: right;
      }

      .parent-signature {
        float: left;
      }

      .comment {
        margin-top: 20px;
        float: inline-end;
        font-weight: bold;
      }

      .header {
        text-align: center;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px;
      }

      .logo {
        width: 100%;
        height: auto;
        /* border: 1px solid black; */
      }

      .school-info {
        flex-grow: 1;
        text-align: center;
      }

      .student-passport {
        width: 100px;
        height: auto;
        /* border: 1px solid black; */
      }
      p {
        display: block;
        margin-top: 0.1em;
        margin-bottom: 0.1em;
        margin-left: 0;
        margin-right: 0;
      }
      .pay {
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: 0;
        margin-right: 0;
      }
      .photo {
            width: 80%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
            position: absolute;
            top: 14em;
            left: 5em;
            z-index: -1;
        }
    </style>
  </head>
  <body>
    <div class="letter">
        <img style="opacity:.1;" class="photo"
            src="{{ asset('assets/images/favicon.png') }}"
            alt="Background Image">
      <div class="header">
        <img
          class="logo"
          src="{{asset('imagelayout.png')}}"
          alt="School Logo"
        />
      </div>

      <div class="matric-date">
        <div class="matric">
          <p style="color: red">PROVOST</p>
          <p style="font-weight: bold">Dr. Felix S. Olawoye FPA.</p>
          <p style="font-weight: bold">B.ch.D, MPA, MPH, FAIPH</p>
        </div>
        <div class="date">
          <p style="color: red">OFFICE OF THE REGISTRAR</p>
          <p style="font-weight: bold">P.M.B. 791, Akure, Ondo State</p>
          <p style="font-weight: bold">Tel: 08035675517</p>
        </div> 
      </div>
      <br /><br /><br />
      <div class="matric-date">
        <div class="matric">
          <p style="font-weight: bold">REGISTRAR</p>
          <p style="font-weight: bold">Omotoso Babatunde Ezekiel</p>
          <p style="font-weight: bold">M.sc, Bsc, OND</p>
        </div>
        <div class="date">
          <p style="font-weight: bold; margin-right: 0em">@php
$referenceNumber = 'Ref: '.$candidateInfo->session.'/CHT/' . sprintf("%04d", $candidateInfo->Admissionlist->count);
echo $referenceNumber;
@endphp</p>
          <p style="font-weight: bold; margin-right: 0em">
            DATE: {{ $currentTime }};
          </p>
        </div>
      </div>
      <br /><br /><br />
      <div class="matric-date">
        <div class="matric">
                  <p style="font-weight: bold">
          {{ !empty($candidateInfo->surname) ? $candidateInfo->surname : 'null'
          }} {{ !empty($candidateInfo->firstname) ? $candidateInfo->firstname :
          'null' }}
        </p>
        </div>
        <div class="date">
        <p style="font-weight: bold; margin-right: 4em">
           {{ !empty($candidateInfo->admissionnumber) ?
          $candidateInfo->admissionnumber : 'null' }}
        </p>
        </div>
      </div>
       
<br /><br /><br />
      <div class="topic">
        OFFER OF PROVISIONAL ADMISSION FOR {{ $candidateInfo->session }} / {{
        ($candidateInfo->session ) + 1 }} ACADEMIC SESSION
      </div>

      <div class="body">
        <p class="pay">
          &nbsp;&nbsp;I am pleased to inform you that you have been offered a
          provisional admission into {{ $candidateInfo->session }}/{{
          ($candidateInfo->session ) + 1 }} academic session in pursuance of
          academic programme leading to the award of diploma in {{
          !empty($candidateInfo->candidateInstitution->firstchoicecourse) ?
          $candidateInfo->candidateInstitution->firstchoicecourse : 'no course
          found' }}
        </p>
        <p class="pay">
          2. Consequently, the College admission is very selective due to its
          standards. &nbsp; &nbsp;
          It is therefore imperative to 
          take note of the following
          conditions, which are related to your admission and registration:
        </p>
        <p class="pay">
          &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;i. That this offer of admission
          is strictly provisional and will be revoked if:
        </p>
        <p class="pay" style="margin-left: 6em">
          a. &nbsp;&nbsp; &nbsp;you don't meet the cutoff mark of your proposed
          course at the <b>probation examination,</b>
        </p>
        <p class="pay" style="margin-left: 6em">
          b. &nbsp;&nbsp; &nbsp;you fail to formally accept this offer by paying
          the acceptance fee of <br />
        </p>
        <p class="pay" style="margin-left: 8em">
          <b>Twenty five thousand naira (N25,000.00) only </b> and other charges
          within the stipulated time in <br />
        </p>
        <p class="pay" style="margin-left: 8em">paragraph 3</p>
        <p class="pay" style="margin-left: 6em">
          c. &nbsp;&nbsp;you cannot produce, at the time of registration, the
          original copies of your certificates<br />
        </p>
        <p class="pay" style="margin-left: 8em">
          with other required academic credentials.
        </p>
        <p class="pay">
          &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
          ii. Contact the Account Unit of the College to pay the Acceptance Fee
          into the designated College account.
        </p>
        <p class="pay">
          3. If you accept this offer of admission, kindly complete the attached
          response form and return same to the Registrar's Office <b>in less than two(2) weeks of the receipt of this letter</b></p>
         <p class="pay"> 4. Once
          again, congratulations.
        </p>
      </div>
      <div class="right">
        <p style="font-weight: bold"> <img style="width:6em; height:4em;"
            src="{{ asset('registrar.png') }}"
            alt="Background Image"></p>
         <p style="font-weight: bold">OMOTOSO E. B.</p>
        <p style="font-weight: bold">Registrar</p>
      </div>
<i>{{ $time }}-</i><i style="font-weight:700;">{{ !empty($candidateInfo->candidateresult->score) ? $candidateInfo->candidateresult->score : '0' }}</i>
      <div class="footer">
        <!--<div class="student">-->
        <!--  -----------------------------------------<br />STUDENT’S SIGNATURE-->
        <!--</div>-->
        <div class="parent-signature"> </div>
      </div>

     </div>
  </body>
</html>
