<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Видеозапись от STOCKWELL</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/vue-material.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/theme/default.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        @font-face {
            font-family: google_font;
            src: url(assets/fonts_google/GoogleSans.ttf);
        }

        body {
            font-family: google_font;
            color: #1D1D1E;
            overflow-x: hidden;
        }

        .img-delete {
            width: 20px;
            cursor: pointer;
        }

        .footer ul li {
            padding: 0 10px;
        }

        .custom-btn {
            background: rgb(59, 200, 245);
            box-shadow: 0px 3px 6px rgba(145, 145, 145, 0.29);
            border-radius: 2px;
            color: #fff;
            border: rgb(59, 200, 245);
            padding: 12px 35px;
            font-size: 18px;
            white-space: nowrap;
            transition: all .3s;
        }

        .custom-btn:hover {
            background: rgb(70, 207, 251);
        }

        .table thead th {
            border-bottom: 0;
            background: #e6e6e647;
            border-top: 0;
        }

        .active-modal-container {
            filter: blur(4px);
        }

        .custom-modal-ipeye {
            max-width: 400px!important;
        }

        .md-overlay {
            background: rgba(228, 228, 228, 0.24);
        }

        .preview_image {
            background: #fff;
            background-size: cover;
            width: 100px;
            height: 80px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            -webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
            box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
        }

        .table td, .table th {
            border-top: 0px;
        }

        table .title {
            font-size: 20px;
            font-weight: 500;
        }

        table .date {
            font-size: 16px;
            color: #a2a2a2;
            font-weight: 400;
        }

        table .icon_cameras {
            position: relative;
            width: 25px;
            cursor: pointer;
        }

        .archiver {
            position: absolute;
            top: -10px;
            left: -14px;
            background: #0088e6;
            color: #fff;
            padding: 1px 7px;
            border-radius: 3px;
            font-weight: 400;
            -webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
            box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
        }

        .active-modal-container {
            filter: blur(4px);
        }

        .custom-modal-ipeye {
            max-width: 400px!important;
        }

        .md-overlay {
            background: rgba(228, 228, 228, 0.24);
        }

        .md-dialog {
            max-height: 100%;
            box-shadow: 0 4px 10px -7px rgba(138, 136, 136, 0.2), 0 11px 13px 3px rgba(101, 100, 100, 0.14), 0 6px 18px -6px rgba(109, 108, 108, 0.12);
        }

        .md-dialog input {
            margin-bottom: 10px;
        }

        .md-dialog .custom-btn {
            margin-bottom: 0px;
        }

        .md-overlay {
            background: rgba(255, 255, 255, 0.35);
        }

        .custom-modal-ipeye section {
            padding: 0px 30px 30px;
        }

        tbody tr {
            transition: all .3s;
        }

        tbody tr:hover {
            cursor: pointer;
            background: #f9f9f9db;
            border-radius: 7px;
        }

        .select_cameras {
            box-shadow: 0px 3px 6px rgba(145, 145, 145, 0.29);
            border-radius: 2px;
            padding: 10px 35px;
            font-size: 18px;
            border: none;
            background: #efefef96;
        }

        .custom-modal-ipeye-error {

        }
    </style>

</head>
<body>
    <div id="app">
        <div class="container" :class="[{'active-modal-container':question, 'active-modal-container':error}]">
            <div class="row d-flex flex-column bd-highlight">

                <div class="row bd-highlight">
                    <!-- HEADER -->
                    <div class="col-sm-12  mt-4 mb-4 d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-center align-items-center">
<!--                            <md-field class="mr-3" v-if="record">-->
<!--                                <label for="camera">Выберите камеру</label>-->
<!--                                <md-select v-model="camera" name="camera" id="camera">-->
<!--                                    <md-option  v-for="(item, index) in cameras" :value="index">{{item.nameCamera}}</md-option>-->
<!--                                </md-select>-->
<!--                            </md-field>-->

                            <select v-model="camera" name="camera" id="camera" class="mr-3 select_cameras"  v-if="record">
                                <option value="">Выберите камеру</option>
                                <option v-for="(item, index) in cameras" :value="index">{{item.nameCamera}}</option>
                            </select>
                            <button class="custom-btn" @click="startRecord" v-if="record">Начать запись</button>
                            <button class="custom-btn" @click="endRecord" v-if="!record">Закончить запись</button>
                        </div>
    <!--                    <button class="custom-btn" @click="question = true">Задать вопрос</button>-->
                    </div>
                    <!-- ./HEADER -->

                    <!-- TABLE -->
                    <div class="col-sm-12 mb-5">

                        <table class="table table-cameras" v-if="!recodrs_no">
                            <tr class="d-flex justify-content-between" v-for="record in records">
                                <th>
                                    <div class="d-flex position-relative">
                                        <div class="archiver" v-if="record.archive == 'Y'">Архив</div>
                                        <div class="preview_image" :style="{ backgroundImage: 'url(data:image/jpeg;base64,' + record.preview + ')' }"></div>
                                        <div class="d-flex flex-column justify-content-center ml-3">
                                            <span class="title">{{record.camera_name}}</span>
                                            <span class="date mt-1">{{record.date_start}}</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="d-flex justify-content-center align-items-center">
                                    <a :href="record.url_show" target="_blank" method="post"><img src="assets/play.svg" class="icon_cameras"></a>
                                    <a :href="record.link_video" target="_blank"><img src="assets/download.svg" class="icon_cameras ml-5"></a>
                                    <img src="assets/delete.svg" alt="" class="icon_cameras ml-5" @click="deleteRecord(record.id)">
                                </td>
                            </tr>
                        </table>
                        <h1 class="text-center" v-if="recodrs_no">Нет записей</h1>
                    </div>
                    <!-- ./TABLE-->
                </div>

                <div class="row bd-highlight mt-auto mb-4">
                    <!-- FOOTER -->
                    <div class="col-sm-12 mb-2 footer">
                        <ul class="d-flex justify-content-center align-items-center">
                            <li><a href="#" @click="question = true">Сообщить об ошибке</a></li>
                            <li>
                                <a href="http://3093609.ru/">
                                    <svg width="148" height="28" viewBox="0 0 148 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.5315 3.97518C12.5793 3.78513 12.6034 3.58358 12.6034 3.37602C12.6034 2.01878 11.5164 0.91607 10.175 0.91607C9.63557 0.91607 9.13564 1.09617 8.73252 1.39804C8.14003 0.551814 7.1652 0 6.06323 0C4.25609 0 2.79178 1.48201 2.79178 3.3131C2.79178 3.49491 2.80611 3.67213 2.83438 3.84412C1.25222 3.95242 0 5.28702 0 6.91814C0 8.62053 1.36078 10 3.04091 10H11.6258C13.3058 10 14.6667 8.62053 14.6667 6.91814C14.6667 5.53644 13.7686 4.36677 12.5315 3.97518Z" fill="#006CB7"/>
                                        <path d="M18.0545 11.6823L16.5684 19.0571C16.5365 19.2093 16.4574 19.3332 16.1887 19.3332H14.2591C14.0695 19.3332 13.9747 19.223 14.0058 19.0571L15.4926 11.6823C15.5244 11.5301 15.6828 11.4058 15.8562 11.4058H17.7858C17.9598 11.4058 18.0864 11.4887 18.0545 11.6823ZM15.714 10.23L15.9672 8.94299C15.999 8.79079 16.0938 8.6665 16.3471 8.6665H18.4026C18.5927 8.6665 18.7032 8.73572 18.6557 8.94299L18.4026 10.23C18.3712 10.3816 18.276 10.5067 18.0233 10.5067H15.9672C15.7777 10.5068 15.6828 10.396 15.714 10.23Z" fill="#FCB216"/>
                                        <path d="M23.3334 12.0279L23.1484 13.1768C23.1236 13.3329 22.9999 13.4609 22.8641 13.4609H21.8521L21.21 17.588C21.1851 17.7581 21.173 17.8861 21.173 17.985C21.173 18.1981 21.2597 18.2552 21.5186 18.2552H22.1236C22.2468 18.2552 22.3455 18.3112 22.3455 18.4532C22.3455 18.4671 22.3455 18.4824 22.3455 18.4964L22.1728 19.6027C22.1484 19.7448 22.0618 19.8577 21.9011 19.8858C21.5184 19.9568 21.2595 19.9998 20.9012 19.9998C19.7781 19.9998 19.1483 19.5316 19.1483 18.2972C19.1483 18.0854 19.173 17.8442 19.21 17.574L19.8396 13.4609L18.8766 13.2763C18.7534 13.2478 18.6667 13.1627 18.6667 13.0207C18.6667 13.0067 18.6667 12.9928 18.6667 12.9782L18.8025 12.0424C18.8274 11.8865 18.9754 11.7443 19.1112 11.7443H20.0989L20.2718 10.5814C20.2967 10.4254 20.4197 10.3258 20.5683 10.2973L22.1235 9.99976C22.1357 9.99976 22.1484 9.99976 22.1605 9.99976C22.2716 9.99976 22.3454 10.0707 22.3454 10.1984C22.3454 10.2122 22.3454 10.2269 22.3454 10.2409L22.1108 11.7444H23.1234C23.247 11.7444 23.3331 11.844 23.3331 11.9854C23.3334 12 23.3334 12.0139 23.3334 12.0279Z" fill="#FCB216"/>
                                        <path d="M26.2539 27.3332H11.0789C7.91089 27.3332 5.33331 24.7553 5.33331 21.5875V14.259C5.33331 12.9928 6.35977 11.9664 7.62563 11.9664C8.89162 11.9664 9.91796 12.9929 9.91796 14.259V21.5875C9.91796 22.2278 10.4387 22.7482 11.0788 22.7482H26.2537C26.8941 22.7482 27.415 22.2277 27.415 21.5875V6.41218C27.415 5.77209 26.8941 5.25131 26.2537 5.25131H18.5555C17.2897 5.25131 16.2632 4.22497 16.2632 2.95897C16.2632 1.69285 17.2897 0.666504 18.5555 0.666504H26.2539C29.4223 0.666504 32 3.2441 32 6.41218V21.5875C32 24.7553 29.4223 27.3332 26.2539 27.3332Z" fill="#FCB216"/>
                                        <path d="M45.652 22.6667C44.4855 22.6667 43.4485 22.5173 42.5413 22.2187C41.634 21.92 40.7834 21.4139 39.9895 20.7004C39.552 20.3022 39.3333 19.8625 39.3333 19.3813C39.3333 18.9997 39.471 18.6679 39.7465 18.3858C40.0219 18.0871 40.354 17.9378 40.7429 17.9378C41.0507 17.9378 41.3261 18.0373 41.5691 18.2364C42.2172 18.784 42.8491 19.1822 43.4648 19.4311C44.0804 19.68 44.8095 19.8044 45.652 19.8044C46.5593 19.8044 47.337 19.597 47.985 19.1822C48.6493 18.7674 48.9814 18.253 48.9814 17.6391C48.9814 16.8924 48.6574 16.3117 48.0093 15.8969C47.3613 15.4655 46.3325 15.1419 44.9229 14.9262C41.3747 14.3953 39.6006 12.7028 39.6006 9.84889C39.6006 8.80356 39.868 7.89926 40.4026 7.136C40.9373 6.35615 41.6664 5.76711 42.5899 5.36889C43.5134 4.95407 44.5422 4.74667 45.6763 4.74667C46.697 4.74667 47.6529 4.9043 48.544 5.21955C49.4513 5.53481 50.2047 5.94963 50.8041 6.464C51.274 6.84563 51.5089 7.28533 51.5089 7.78311C51.5089 8.16474 51.3712 8.50489 51.0958 8.80355C50.8203 9.08563 50.4963 9.22667 50.1237 9.22667C49.8806 9.22667 49.6619 9.152 49.4675 9.00267C49.0462 8.65422 48.4549 8.33896 47.6934 8.05689C46.9481 7.75822 46.2757 7.60889 45.6763 7.60889C44.6556 7.60889 43.8617 7.808 43.2946 8.20622C42.7438 8.58785 42.4683 9.09392 42.4683 9.72444C42.4683 10.4379 42.7519 10.9772 43.3189 11.3422C43.9022 11.7073 44.8095 12.0059 46.0408 12.2382C47.4342 12.4871 48.544 12.8107 49.3703 13.2089C50.2128 13.5905 50.8446 14.1215 51.2659 14.8018C51.6871 15.4655 51.8977 16.3532 51.8977 17.4649C51.8977 18.5102 51.6061 19.4311 51.0228 20.2276C50.4558 21.0074 49.6943 21.613 48.7384 22.0444C47.7825 22.4593 46.7537 22.6667 45.652 22.6667Z" fill="#006CB7"/>
                                        <path d="M60.7118 19.6053C60.9386 19.6053 61.1411 19.7215 61.3194 19.9538C61.5138 20.1695 61.611 20.4599 61.611 20.8249C61.611 21.2729 61.368 21.6545 60.8819 21.9698C60.4121 22.2684 59.8774 22.4178 59.2779 22.4178C58.2734 22.4178 57.4228 22.2021 56.7262 21.7707C56.0457 21.3227 55.7055 20.3852 55.7055 18.9582V12.0889H54.5875C54.1987 12.0889 53.8747 11.9561 53.6154 11.6907C53.3562 11.4252 53.2266 11.0933 53.2266 10.6951C53.2266 10.3135 53.3562 9.99822 53.6154 9.74933C53.8747 9.48385 54.1987 9.35111 54.5875 9.35111H55.7055V7.75822C55.7055 7.32681 55.8432 6.97007 56.1186 6.688C56.4102 6.38933 56.7667 6.24 57.1879 6.24C57.593 6.24 57.9332 6.38933 58.2086 6.688C58.4841 6.97007 58.6218 7.32681 58.6218 7.75822V9.35111H60.3473C60.7361 9.35111 61.0601 9.48385 61.3194 9.74933C61.5786 10.0148 61.7082 10.3467 61.7082 10.7449C61.7082 11.1265 61.5786 11.4501 61.3194 11.7156C61.0601 11.9644 60.7361 12.0889 60.3473 12.0889H58.6218V18.8338C58.6218 19.1822 58.7109 19.4394 58.8891 19.6053C59.0673 19.7547 59.3103 19.8293 59.6182 19.8293C59.7478 19.8293 59.926 19.7961 60.1528 19.7298C60.3473 19.6468 60.5336 19.6053 60.7118 19.6053Z" fill="#006CB7"/>
                                        <path d="M76.7587 15.7724C76.7587 17.0999 76.4671 18.2945 75.8838 19.3564C75.3006 20.4018 74.4986 21.2148 73.4779 21.7956C72.4733 22.3763 71.3635 22.6667 70.1484 22.6667C68.9171 22.6667 67.7992 22.3763 66.7946 21.7956C65.7901 21.2148 64.9963 20.4018 64.413 19.3564C63.8297 18.2945 63.5381 17.0999 63.5381 15.7724C63.5381 14.445 63.8297 13.2587 64.413 12.2133C64.9963 11.1514 65.7901 10.3301 66.7946 9.74933C67.7992 9.152 68.9171 8.85333 70.1484 8.85333C71.3635 8.85333 72.4733 9.152 73.4779 9.74933C74.4986 10.3301 75.3006 11.1514 75.8838 12.2133C76.4671 13.2587 76.7587 14.445 76.7587 15.7724ZM73.8424 15.7724C73.8424 14.9594 73.6723 14.2376 73.332 13.6071C73.008 12.96 72.5625 12.4622 71.9954 12.1138C71.4445 11.7653 70.8289 11.5911 70.1484 11.5911C69.4679 11.5911 68.8442 11.7653 68.2771 12.1138C67.7262 12.4622 67.2807 12.96 66.9405 13.6071C66.6164 14.2376 66.4544 14.9594 66.4544 15.7724C66.4544 16.5855 66.6164 17.3073 66.9405 17.9378C67.2807 18.5683 67.7262 19.0578 68.2771 19.4062C68.8442 19.7547 69.4679 19.9289 70.1484 19.9289C70.8289 19.9289 71.4445 19.7547 71.9954 19.4062C72.5625 19.0578 73.008 18.5683 73.332 17.9378C73.6723 17.3073 73.8424 16.5855 73.8424 15.7724Z" fill="#006CB7"/>
                                        <path d="M84.8577 8.85333C86.2349 8.85333 87.3447 9.07733 88.1872 9.52533C89.0297 9.95674 89.4509 10.5375 89.4509 11.2676C89.4509 11.6326 89.3456 11.9561 89.135 12.2382C88.9244 12.5037 88.6489 12.6364 88.3087 12.6364C88.0495 12.6364 87.8388 12.6033 87.6768 12.5369C87.5148 12.4539 87.3528 12.3544 87.1908 12.2382C87.045 12.1055 86.8991 11.9976 86.7533 11.9147C86.5913 11.8317 86.3483 11.757 86.0242 11.6907C85.7164 11.6243 85.4653 11.5911 85.2709 11.5911C84.0557 11.5911 83.0998 11.981 82.4032 12.7609C81.7227 13.5241 81.3825 14.528 81.3825 15.7724C81.3825 16.9671 81.7308 17.9627 82.4275 18.7591C83.1241 19.539 84.0152 19.9289 85.1008 19.9289C85.8946 19.9289 86.486 19.8293 86.8748 19.6302C86.972 19.5804 87.1017 19.4975 87.2637 19.3813C87.4419 19.2486 87.6039 19.149 87.7497 19.0827C87.8955 19.0163 88.0738 18.9831 88.2844 18.9831C88.6894 18.9831 89.0054 19.1159 89.2322 19.3813C89.4752 19.6468 89.5967 19.987 89.5967 20.4018C89.5967 20.8 89.3699 21.1733 88.9163 21.5218C88.4626 21.8702 87.8631 22.1523 87.1179 22.368C86.3726 22.5671 85.5787 22.6667 84.7362 22.6667C83.4887 22.6667 82.387 22.368 81.4311 21.7707C80.4914 21.1733 79.7623 20.352 79.2438 19.3067C78.7254 18.2447 78.4661 17.0667 78.4661 15.7724C78.4661 14.4284 78.7335 13.2338 79.2681 12.1884C79.819 11.1431 80.5805 10.3301 81.5526 9.74933C82.5247 9.152 83.6264 8.85333 84.8577 8.85333Z" fill="#006CB7"/>
                                        <path d="M102.517 19.8044C102.825 20.1363 102.979 20.5096 102.979 20.9244C102.979 21.3393 102.817 21.6877 102.493 21.9698C102.185 22.2519 101.853 22.3929 101.496 22.3929C101.075 22.3929 100.719 22.227 100.427 21.8951L96.0527 17.1662L94.8618 18.2862V20.8996C94.8618 21.331 94.7241 21.696 94.4487 21.9947C94.1733 22.2767 93.8249 22.4178 93.4037 22.4178C92.9824 22.4178 92.6341 22.2767 92.3587 21.9947C92.0832 21.696 91.9455 21.331 91.9455 20.8996V5.51822C91.9455 5.08681 92.0832 4.73007 92.3587 4.448C92.6341 4.14933 92.9824 4 93.4037 4C93.8249 4 94.1733 4.14933 94.4487 4.448C94.7241 4.73007 94.8618 5.08681 94.8618 5.51822V14.7271L100.063 9.57511C100.37 9.25985 100.727 9.10222 101.132 9.10222C101.488 9.10222 101.804 9.25985 102.08 9.57511C102.371 9.87378 102.517 10.1807 102.517 10.496C102.517 10.8942 102.323 11.2676 101.934 11.616L98.2642 15.0756L102.517 19.8044Z" fill="#006CB7"/>
                                        <path d="M120.509 9.10222C120.898 9.10222 121.222 9.25155 121.481 9.55022C121.757 9.8323 121.894 10.1973 121.894 10.6453C121.894 10.7947 121.862 10.9855 121.797 11.2178L118.079 21.472C117.982 21.7707 117.804 22.0113 117.544 22.1938C117.301 22.3597 117.034 22.4427 116.742 22.4427L116.548 22.4178C115.997 22.3846 115.584 22.0693 115.308 21.472L113.243 15.3493L111.274 21.472C110.999 22.0693 110.586 22.3846 110.035 22.4178L109.84 22.4427C109.549 22.4427 109.273 22.3597 109.014 22.1938C108.771 22.0113 108.601 21.7707 108.504 21.472L104.785 11.2178C104.721 11.0353 104.688 10.8444 104.688 10.6453C104.688 10.2305 104.818 9.87378 105.077 9.57511C105.353 9.25985 105.709 9.10222 106.146 9.10222C106.47 9.10222 106.746 9.18518 106.973 9.35111C107.216 9.50044 107.386 9.73274 107.483 10.048L110.108 17.3404L112.028 12.0142C112.287 11.4003 112.732 11.0933 113.364 11.0933C113.704 11.0933 113.964 11.168 114.142 11.3173C114.336 11.4667 114.498 11.699 114.628 12.0142L116.499 17.216L119.1 10.048C119.197 9.73274 119.367 9.50044 119.61 9.35111C119.853 9.18518 120.153 9.10222 120.509 9.10222Z" fill="#006CB7"/>
                                        <path d="M135.858 15.4489C135.842 15.8471 135.688 16.1707 135.396 16.4196C135.105 16.6684 134.765 16.7929 134.376 16.7929H126.356C126.55 17.7719 126.996 18.5434 127.693 19.1076C128.389 19.6551 129.175 19.9289 130.05 19.9289C130.714 19.9289 131.233 19.8708 131.605 19.7547C131.978 19.6219 132.27 19.4892 132.48 19.3564C132.707 19.2071 132.861 19.1076 132.942 19.0578C133.234 18.9084 133.509 18.8338 133.768 18.8338C134.108 18.8338 134.4 18.9582 134.643 19.2071C134.886 19.456 135.008 19.7464 135.008 20.0782C135.008 20.5262 134.781 20.9327 134.327 21.2978C133.873 21.6794 133.266 22.003 132.504 22.2684C131.743 22.5339 130.973 22.6667 130.196 22.6667C128.835 22.6667 127.644 22.3763 126.623 21.7956C125.619 21.2148 124.841 20.4184 124.29 19.4062C123.739 18.3775 123.464 17.2243 123.464 15.9467C123.464 14.5197 123.756 13.267 124.339 12.1884C124.922 11.1099 125.692 10.2886 126.648 9.72444C127.603 9.1437 128.624 8.85333 129.71 8.85333C130.779 8.85333 131.783 9.152 132.723 9.74933C133.679 10.3467 134.441 11.1514 135.008 12.1636C135.575 13.1757 135.858 14.2708 135.858 15.4489ZM129.71 11.5911C127.83 11.5911 126.72 12.4954 126.38 14.304H132.747V14.1298C132.683 13.4329 132.351 12.8356 131.751 12.3378C131.152 11.84 130.471 11.5911 129.71 11.5911Z" fill="#006CB7"/>
                                        <path d="M141.45 20.8996C141.45 21.331 141.304 21.696 141.012 21.9947C140.737 22.2767 140.388 22.4178 139.967 22.4178C139.562 22.4178 139.222 22.2767 138.947 21.9947C138.671 21.696 138.533 21.331 138.533 20.8996V5.51822C138.533 5.08681 138.671 4.73007 138.947 4.448C139.238 4.14933 139.595 4 140.016 4C140.421 4 140.761 4.14933 141.037 4.448C141.312 4.73007 141.45 5.08681 141.45 5.51822V20.8996Z" fill="#006CB7"/>
                                        <path d="M148 20.8996C148 21.331 147.854 21.696 147.563 21.9947C147.287 22.2767 146.939 22.4178 146.518 22.4178C146.112 22.4178 145.772 22.2767 145.497 21.9947C145.221 21.696 145.084 21.331 145.084 20.8996V5.51822C145.084 5.08681 145.221 4.73007 145.497 4.448C145.788 4.14933 146.145 4 146.566 4C146.971 4 147.311 4.14933 147.587 4.448C147.862 4.73007 148 5.08681 148 5.51822V20.8996Z" fill="#006CB7"/>
                                    </svg>
                                </a>
                            </li>
                            <li><a href="http://3093609.ru/" target="_blank">Наши приложения</a></li>
                        </ul>
                    </div>
                    <!-- ./FOOTER -->

                    <!-- QUESTION -->
                    <div class="col-sm-12 text-center">
                    <span>
                        У Вас есть предложения по доработкам? <a href="#" @click="question = true"><b>Напишите нам</b></a> и мы их обязательно реализуем.
                    </span>
                    </div>
                    <!-- ./QUESTION -->
                </div>

            </div>
        </div>

        <!-- MODAL-QUESTIONS -->
        <md-dialog :md-active.sync="question">
            <div class="container custom-modal-ipeye">
                <div class="row">
                    <header>
                        <h3>Задать вопрос</h3>
                    </header>
                    <section>
                        <input type="text" v-model="question_form.name" placeholder="Ваше Имя">
                        <input type="text" v-model="question_form.email" placeholder="Email">
                        <input type="text" v-model="question_form.phone" placeholder="Телефон">
                        <input type="text" v-model="question_form.text" placeholder="Ваш Вопрос">
                        <footer class="d-flex justify-content-center">
                            <button class="custom-btn"  @click="sendQuestion()">Отправить</button>
                        </footer>
                    </section>
                </div>
            </div>
        </md-dialog>
        <!-- ./MODAL-QUESTIONS-->

<!--         MODAL-ERROR -->
<!--        <md-dialog :md-active.sync="error">-->
<!--            <div class="container custom-modal-ipeye custom-modal-ipeye-error">-->
<!--                <div class="row">-->
<!--                    <header>-->
<!--                        <h3>Для продолжения Вам необходимо включить запись CRM в личном кабинете</h3>-->
<!--                    </header>-->
<!--                </div>-->
<!--            </div>-->
<!--        </md-dialog>-->
<!--         ./MODAL-ERROR-->

    </div>

    <script src="//api.bitrix24.com/api/v1/"></script>
    <script rel="stylesheet" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script rel="stylesheet" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script rel="stylesheet" src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue-material"></script>
    <script>

        Vue.use(VueMaterial.default);

        var portal = '<?=$_REQUEST['DOMAIN']?>';

        var app = new Vue({
            el: '#app',
            data: {
                error: false,
                record: true,
                records: [],
                recodrs_no: false,
                question: false,
                camera: '',
                cameras: [],
                question_form: {
                    name: '',
                    email: '',
                    phone: '',
                    text: ''
                }
            },
            methods: {
                sendQuestion() {

                    var ctx = this;
                    ctx.question = false;

                    const data = new FormData();
                    data.append('data', JSON.stringify(this.question_form));
                    data.append('type', 'request');
                    data.append('portal', portal);


                    axios({
                        url: 'https://b24apps.ru/local/b24apps/our_app/scripts_for_all_apps/workPortal/lead.php',
                        method: 'POST',
                        data: data
                    }).then((response) => {});

                },
                startRecord() {


                    var url = 'https://ipeye.ru/ipeye_service/model_proc/proc_get_device_tariff.php?devcode='+ this.cameras[this.camera].idCamera +'';

                    axios({
                        url: url,
                        method: 'POST',
                    }).then((response) => {

                        response.data = 17;

                        if(response.data != 17) {
                            alert('Для продолжения Вам необходимо включить запись CRM в личном кабинете');
                        } else {
                            const data = new FormData();
                            data.append('portal', portal);
                            data.append('camera_id', this.cameras[this.camera].idCamera);
                            data.append('camera_name', this.cameras[this.camera].nameCamera);
                            data.append('placement', '<?=$_REQUEST['PLACEMENT'];?>');
                            data.append('id', <?=json_decode($_REQUEST['PLACEMENT_OPTIONS'], true)['ID']?>);

                            axios({
                                url: 'https://b24apps.ru/local/b24apps/our_app/ipeye/php/startVideo.php',
                                method: 'POST',
                                data: data
                            });

                            this.record = false;
                        }
                    });


                },
                endRecord() {

                    let ctx = this;

                    const data = new FormData();
                    data.append('portal', portal);
                    data.append('camera_id', this.camera);
                    data.append('placement', '<?=$_REQUEST['PLACEMENT'];?>');
                    data.append('id', <?=json_decode($_REQUEST['PLACEMENT_OPTIONS'], true)['ID']?>);

                    axios({
                        url: 'https://b24apps.ru/local/b24apps/our_app/ipeye/php/endVideo.php',
                        method: 'POST',
                        data: data
                    }).then((response) => {
                        ctx.getCurrentVideo();
                    });

                    this.record = true;

                },
                getCurrentVideo() {
                    var ctx = this;

                    const data = new FormData();
                    data.append('portal', portal);
                    data.append('placement', '<?=$_REQUEST['PLACEMENT'];?>');
                    data.append('id', <?=json_decode($_REQUEST['PLACEMENT_OPTIONS'], true)['ID']?>);

                    axios({
                        url: 'https://b24apps.ru/local/b24apps/our_app/ipeye/php/getCurrentVideo.php',
                        method: 'POST',
                        data: data
                    }).then((response) => {
                        //console.log(response)

                        ctx.records = [];

                        for (let item of response.data) {
                            if(item.active == 'N') {
                                ctx.records.push(item);
                            } else {
                                ctx.record = false
                            }
                        }

                        if (ctx.records.length == 0) {
                            ctx.recodrs_no = true;
                        } else {
                            ctx.recodrs_no = false;
                        }

                        setTimeout(function () {
                            ctx.fuckingSizeWindow()
                        }, 150)
                        
                    });
                },
                getDataPortal() {
                    var ctx = this;

                    const data = new FormData();
                    data.append('portal', portal);

                    axios({
                        url: 'https://b24apps.ru/local/b24apps/our_app/ipeye/php/portal.php',
                        method: 'POST',
                        data: data
                    }).then((response) => {
                        ctx.cameras = response.data
                        setTimeout(function () {
                            ctx.fuckingSizeWindow()
                        }, 150)
                    });
                },
                deleteRecord(id_record) {
                    let ctx = this;

                    const data = new FormData();
                    data.append('id', id_record);

                    axios({
                        url: 'https://b24apps.ru/local/b24apps/our_app/ipeye/php/deleteRecords.php',
                        method: 'POST',
                        data: data
                    }).then((response) => {
                        ctx.getCurrentVideo();
                    });
                },
                fuckingSizeWindow() {

                    var body = document.body;
                    var html = document.documentElement;

                    var height = Math.max(body.scrollHeight, body.offsetHeight,
                        html.clientHeight, html.scrollHeight, html.offsetHeight);

                    var width = Math.max(body.scrollWidth, body.offsetWidth,
                        html.clientWidth, html.scrollWidth, html.offsetWidth);

                    BX24.resizeWindow(width, document.body.offsetHeight)
                },
                getUser() {
                    var ctx = this;

                    BX24.callMethod('user.current', {}, function(res){
                        ctx.question_form.name = res.data().NAME;
                        ctx.question_form.phone = res.data().PERSONAL_MOBILE;
                        ctx.question_form.email = res.data().EMAIL;
                    });
                }
            },
            created() {
                this.getCurrentVideo();
                this.getDataPortal();
                this.getUser();
            }
        });



    </script>

</body>
</html>