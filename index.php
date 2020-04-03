<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stockwell IPEYE</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>

<div id="app">
    <div class="container" :class="{'active_container':modalvideo}">
        <div class="row">
            <div class="col-sm-6">
                <div class="title">
                    <span>Для записи выберите камеру и нажмите <b>“Начать запись”</b>. После окончания записи нажмите <b>“Закончить запись”</b></span>
                </div>


                <div  v-if="status == 'NO_RECORD'">

                    <div class="select_cs">
                        <select v-model="chose_camera">
                            <option value="no">Выберите камеру</option>
                            <option v-for="(item, index) in cameras" :value="index">{{item.PROPERTY_VALUES.name_camera}}</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" @click="start_rec()">Начать запись</button>
                </div>

                <div  v-if="status == 'RECORD'">
                    <button type="button" class="btn btn-danger"  @click="stop_rec()">Закончить запись</button>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="title">
                <span>Записи закрепленные за сделкой</span>
            </div>

                <div class="block_video" v-for="item in all_zapici">
                    <div class="block_image" @click="modal_video(item.image_prewie, item.url_video)">

                        <div class="overlay"></div>
                        <img :src="'data:image/jpeg;base64,'+ item.image_prewie" class="prewiew">
                        <div class="icon_show">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve">
                                <circle style="fill:#007BFF;" cx="29" cy="29" r="29"/>
                                <polygon style="fill:#FFFFFF;" points="44,29 22,44 22,29.273 22,14  "/>
                                <path style="fill:#FFFFFF;" d="M22,45c-0.16,0-0.321-0.038-0.467-0.116C21.205,44.711,21,44.371,21,44V14   c0-0.371,0.205-0.711,0.533-0.884c0.328-0.174,0.724-0.15,1.031,0.058l22,15C44.836,28.36,45,28.669,45,29s-0.164,0.64-0.437,0.826   l-22,15C22.394,44.941,22.197,45,22,45z M23,15.893v26.215L42.225,29L23,15.893z"/>
                            </svg>
                        </div>

                    </div>
                    <div class="description">
                        <div class="date_cam">
                            <b>Дата записи:</b> {{item.strat_time | chngedata}}
                        </div>
                        <div class="title_cam">
                            <b>Камера:</b> {{item.cam_name}}
                        </div>
                        <div class="btn_goup">
                            <a :href="item.url_video" target="_blank" class="btn btn-secondary">Скачать</a>
                            <a class="btn btn-delete" @click="deleteVideo(item.id)">Удалить</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal_custom" v-if="modalvideo">
        <div class="modal_container">
            <div class="close_svg" @click="modalvideo = !modalvideo">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 52 52">
                    <g>
                        <path d="M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26
                            S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z"/>
                        <path d="M35.707,16.293c-0.391-0.391-1.023-0.391-1.414,0L26,24.586l-8.293-8.293c-0.391-0.391-1.023-0.391-1.414,0
                            s-0.391,1.023,0,1.414L24.586,26l-8.293,8.293c-0.391,0.391-0.391,1.023,0,1.414C16.488,35.902,16.744,36,17,36
                            s0.512-0.098,0.707-0.293L26,27.414l8.293,8.293C34.488,35.902,34.744,36,35,36s0.512-0.098,0.707-0.293
                            c0.391-0.391,0.391-1.023,0-1.414L27.414,26l8.293-8.293C36.098,17.316,36.098,16.684,35.707,16.293z"/>
                    </g>
                </svg>
            </div>
            <vue-plyr>
                <video :poster="'data:image/jpeg;base64,'+ chose_preview_video" src="video.mp4">
                    <source :src="chose_vide" type="video/mp4" size="720">
                </video>
            </vue-plyr>
        </div>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script type="text/javascript" src="https://unpkg.com/vue-plyr/dist/vue-plyr.js"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-plyr/dist/vue-plyr.css">

<script src="//api.bitrix24.com/api/v1/"></script>
<script src="assets/js/main.js"></script>

</body>
</html>