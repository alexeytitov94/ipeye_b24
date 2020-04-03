var id_deal = <?=json_decode($_REQUEST['PLACEMENT_OPTIONS'])->ID?>;
var entity_sc = '<?=$_REQUEST['PLACEMENT']?>';


Vue.use(VuePlyr)

var app = new Vue({
    el: '#app',
    data: {
        start_record: '',
        end_record: '',
        status: 'NO_RECORD',
        cameras: [],
        id_zapici: '',
        all_zapici: [],
        chose_camera: 'no',
        chose_vide: '',
        chose_preview_video: '',
        modalvideo: false
    },
    methods: {
        start_rec() {
            var ctx = this,
                date_now = Date.now();

            if (ctx.chose_camera == 'no') {
                alert('Выберите камеру')
            } else {
                BX24.callMethod('entity.item.add', {
                    ENTITY: 'IPEYE_ST_APP_DATA',
                    NAME: entity_sc + '_' + id_deal + '_' + date_now,
                    PROPERTY_VALUES: {
                        entity: entity_sc,
                        id: id_deal,
                        start_time: date_now,
                        end_time: '',
                        camera_id: ctx.cameras[ctx.chose_camera].PROPERTY_VALUES.id_camera,
                        camera: ctx.cameras[ctx.chose_camera].PROPERTY_VALUES.name_camera,
                        active: 1
                    }
                }, function (response) {
                    ctx.status = 'RECORD';
                    ctx.id_zapici = response.answer.result;
                });
            }
        },
        stop_rec() {

            var ctx = this,
                date_stop = Date.now();

            //Начать запись
            BX24.callMethod('entity.item.update', {
                ENTITY: 'IPEYE_ST_APP_DATA',
                ID: ctx.id_zapici,
                PROPERTY_VALUES: {
                    end_time: date_stop,
                    link_video: 'https://www.youtube.com/watch?v=sxjAbBTpWkY',
                    active: 0
                }
            }, function (response) {

                ctx.status = 'NO_RECORD';
                ctx.getZapici();
            });
        },
        getResult() {

            var ctx = this;

            //Получаю данные об активной записи
            BX24.callMethod('entity.item.get', {
                ENTITY: 'IPEYE_ST_APP_DATA',
                SORT: {DATE_ACTIVE_FROM: 'ASC', ID: 'ASC'},
                FILTER: {
                    'PROPERTY_id': id_deal,
                    'PROPERTY_entity': entity_sc,
                    'PROPERTY_active': 1
                }
            }, function (response) {

                if (response.answer.total == 0) {
                    ctx.status = 'NO_RECORD';
                } else {
                    ctx.status = 'RECORD';
                    ctx.id_zapici = response.answer.result[0].ID;
                }
            });
        },
        getAllCameras() {
            var ctx = this;

            //Получаю все камеры из хранилища
            BX24.callMethod('entity.item.get', {
                ENTITY: 'IPEYE_ST_APP_CAMER',
                SORT: {DATE_ACTIVE_FROM: 'ASC', ID: 'ASC'},
                FILTER: {}
            }, function (response) {
                ctx.cameras = response.answer.result;
            });
        },
        getZapici(){
            var ctx = this;

            //Получаю все записи
            BX24.callMethod('entity.item.get', {
                ENTITY: 'IPEYE_ST_APP_DATA',
                SORT: {ID: 'ASC'},
                FILTER: {
                'PROPERTY_id': id_deal,
                'PROPERTY_entity': entity_sc,
                'PROPERTY_active': 0
                }
            }, function (response) {
                ctx.getVideoAndPrewie(response.answer.result);
            });
        },
        getVideoAndPrewie(items){

            var ctx = this;
            ctx.all_zapici = [];

            for (item in items) {

                var ctx = this;

                var data_item = {
                    cam_id: items[item].PROPERTY_VALUES.camera_id,
                    strat_time: items[item].PROPERTY_VALUES.start_time,
                    end_time: items[item].PROPERTY_VALUES.end_time,
                    cam_name: items[item].PROPERTY_VALUES.camera,
                }

                const data = new FormData();
                data.append('data', JSON.stringify(data_item));


                axios({
                    url: 'https://b24apps.ru/local/b24apps/alexey/ipeye/api/ipeye_api/get_video.php',
                    method: 'POST',
                    data: data
                }).then((response) => {
                    response.data['id'] = items[item].ID
                    ctx.all_zapici.unshift(response.data);
                }).then(()=>{
                    var body = document.body;
                    var html = document.documentElement;

                    var height = Math.max(body.scrollHeight, body.offsetHeight,
                        html.clientHeight, html.scrollHeight, html.offsetHeight);

                    var width = Math.max(body.scrollWidth, body.offsetWidth,
                        html.clientWidth, html.scrollWidth, html.offsetWidth);


                    BX24.resizeWindow(width, height + 50)
                });
            }
        },
        modal_video(pew, video) {
            this.chose_vide = video;
            this.chose_preview_video = video;
            this.modalvideo = true;
        },
        deleteVideo(id) {

            console.log(id)

            var ctx = this;

            BX24.callMethod('entity.item.delete', {
                ENTITY: 'IPEYE_ST_APP_DATA',
                ID: id
            }, function (res) {

                if(res.status == 200) {
                    ctx.getZapici();
                }
            });
        }
    },
    filters: {
        chngedata(UNIX_timestamp) {

          var a = new Date(UNIX_timestamp * 1);
          var months = ['Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Ноября','Декабря'];
          var year = a.getFullYear();
          var month = months[a.getMonth()];
          var date = a.getDate();
          var hour = a.getHours();
          var min = a.getMinutes();
          var sec = a.getSeconds();

          if (min < 10) {
              min = '0' + min
          }
          if (hour < 10) {
              hour = '0' + hour
          }

          var time =  date + " " + month + " " + year + " " + hour + ":"+min;

          console.log(date + '.' + month + "." + year + " " + hour + ':' + min + ":" + sec)
          return time;
        },
        durationVideo(item) {



            var now = moment(item.strat_time * 1); //todays date
            var end = moment(item.end_time * 1); // another date
            var duration = moment.duration(end.diff(now));
            var days = duration;
            console.log(days.asHours())
            console.log(days.asMinutes())


            return 1;

        }
    },
    created() {
        var ctx = this;
        ctx.getAllCameras();
        ctx.getResult();
        ctx.getZapici();
    },
});