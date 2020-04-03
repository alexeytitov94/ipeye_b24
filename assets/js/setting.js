var app = new Vue({
    el: '#app',
    data: {
        cameras: [],
        modal: false,
        name_camera: '',
        id_camera: ''
    },
    methods: {
        addCamera() {

            var ctx = this;

            BX24.callMethod('entity.item.add', {
                ENTITY: 'IPEYE_ST_APP_CAMER',
                NAME: '234234234',
                PROPERTY_VALUES: {
                    name_camera: ctx.name_camera,
                    id_camera: ctx.id_camera,
                },
            }, function () {

                ctx.modal = false;
                ctx.name_camera = '';
                ctx.id_camera = '';

                BX24.callMethod('entity.item.get', {
                    ENTITY: 'IPEYE_ST_APP_CAMER',
                    SORT: {DATE_ACTIVE_FROM: 'ASC', ID: 'ASC'},
                    FILTER: {}
                }, function (response) {

                    ctx.cameras = response.answer.result;

                });
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
        portal(){

            var info_app = {},
                ctx = this;

            BX24.callMethod('app.info', {
            }, function (response) {

                info_app['LICENSE'] = response.answer.result.LICENSE

                BX24.callMethod('user.current', {}, function(res){

                    info_app['USER_NAME'] = res.answer.result.NAME + " " + res.answer.result.LAST_NAME;
                    info_app['EMAIL'] = res.answer.result.EMAIL;
                    info_app['PHONE_WORK'] = res.answer.result.WORK_PHONE;
                    info_app['PHONE_PERSONAL'] = res.answer.result.PERSONAL_MOBILE;
                    info_app['PORTAL'] = request.DOMAIN;
                    info_app['REFRESH'] = request.REFRESH_ID;
                    info_app['MEMBER'] = request.member_id;


                    const data = new FormData();
                    data.append('data', JSON.stringify(info_app));


                    axios({
                        url: 'https://b24apps.ru/local/b24apps/alexey/ipeye/script/update_portal.php',
                        method: 'POST',
                        data: data
                    }).then((response) => {});


                });

            });
        },
        createdEntity() {
            var ctx = this;

            BX24.callMethod(
                "entity.get",
                {
                    "ENTITY": 'IPEYE_ST_APP_CAMER'
                },
                function(result)
                {

                    if(result.status == 400) {
                        //Добавление нового хранилища с камерами
                        BX24.callMethod('entity.add', {
                            'ENTITY': 'IPEYE_ST_APP_CAMER',
                            'NAME': 'IPEYE_ST_APP_CAMER',
                            'ACCESS': {U1:'W',AU:'R'}
                        }, function () {

                            //Добавление нового поля "Название"
                            BX24.callMethod('entity.item.property.add', {
                                ENTITY: 'IPEYE_ST_APP_CAMER',
                                PROPERTY: 'name_camera',
                                NAME: 'Название камеры',
                                TYPE: 'S'
                            });

                            //Добавление нового поля "ID"
                            BX24.callMethod('entity.item.property.add', {
                                ENTITY: 'IPEYE_ST_APP_CAMER',
                                PROPERTY: 'id_camera',
                                NAME: 'id камеры',
                                TYPE: 'S'
                            });


                        });


                        //Добавление нового хранилища с записями
                        BX24.callMethod('entity.add', {
                            'ENTITY': 'IPEYE_ST_APP_DATA',
                            'NAME': 'IPEYE_ST_APP_DATA',
                            'ACCESS': {U1:'W',AU:'R'}
                        }, function () {

                            //Добавление нового поля "Сущность"
                            BX24.callMethod('entity.item.property.add', {
                                ENTITY: 'IPEYE_ST_APP_DATA',
                                PROPERTY: 'entity',
                                NAME: 'Сущность',
                                TYPE: 'S'
                            });

                            //Добавление нового поля "ID"
                            BX24.callMethod('entity.item.property.add', {
                                ENTITY: 'IPEYE_ST_APP_DATA',
                                PROPERTY: 'id',
                                NAME: 'id',
                                TYPE: 'S'
                            });

                            //Добавление нового поля "start_time"
                            BX24.callMethod('entity.item.property.add', {
                                ENTITY: 'IPEYE_ST_APP_DATA',
                                PROPERTY: 'start_time',
                                NAME: 'Начало записи',
                                TYPE: 'S'
                            });

                            //Добавление нового поля "end_time"
                            BX24.callMethod('entity.item.property.add', {
                                ENTITY: 'IPEYE_ST_APP_DATA',
                                PROPERTY: 'end_time',
                                NAME: 'Конец записи',
                                TYPE: 'S'
                            });

                            //Активность
                            BX24.callMethod('entity.item.property.add', {
                                ENTITY: 'IPEYE_ST_APP_DATA',
                                PROPERTY: 'active',
                                NAME: 'Активность',
                                TYPE: 'S'
                            });

                            //ID Камеры
                            BX24.callMethod('entity.item.property.add', {
                                ENTITY: 'IPEYE_ST_APP_DATA',
                                PROPERTY: 'camera_id',
                                NAME: 'Камера ИД',
                                TYPE: 'S'
                            });

                            //Имя Камеры
                            BX24.callMethod('entity.item.property.add', {
                                ENTITY: 'IPEYE_ST_APP_DATA',
                                PROPERTY: 'camera',
                                NAME: 'Камера',
                                TYPE: 'S'
                            });

                            //Ссылка
                            BX24.callMethod('entity.item.property.add', {
                                ENTITY: 'IPEYE_ST_APP_DATA',
                                PROPERTY: 'link_video',
                                NAME: 'Ссылка на видео',
                                TYPE: 'S'
                            });

                            ctx.getAllCameras();
                            ctx.portal();

                        });

                        BX24.callMethod('placement.bind', {
                            PLACEMENT: 'CRM_DEAL_DETAIL_TAB',
                            HANDLER: 'https://b24apps.ru/local/b24apps/alexey/ipeye/index.php',
                            TITLE: 'Запись видео IPEYE',
                            DESCRIPTION: 'Запись видео IPEYE'
                        }, function (response) {
                            console.log(response)
                        });


                        //Внедрение в карточку сделки

                    } else {
                        ctx.getAllCameras();
                        ctx.portal();
                    }

                }
            );
        }
    },
    created(){

        this.createdEntity();


    }
})