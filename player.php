<!DOCTYPE html>
<html>
<head>
    <title>Stockwell</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        #app {
            font-family: 'Avenir', Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-align: center;
            color: #2c3e50;
            margin-top: 60px;
        }

        .lists .item {
            font-size: 21px;
        }

        .lists .item .title {
            color: #bdbdbd;
        }

        .lists .item p {
        }
    </style>
</head>
<body>

<div id="app">

    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <vue-plyr>
                    <video
                        crossorigin = 'anonymous'
                        playsinline
                        :poster="data_response.preview"
                        :src="data_response.link_video"
                    >
                    </video>
                </vue-plyr>
            </div>
            <div class="col-sm-3">

                <div class="lists">
                    <div class="item">
                        <span class="title">Название камеры</span>
                        <p>{{ data_response.camera_name }}</p>
                    </div>
                    <div class="item">
                        <span class="title">Начало записи</span>
                        <p>{{ data_response.date_start }}</p>
                    </div>
                    <div class="item">
                        <span class="title">Продолжительность</span>
                        <p>{{ data_response.duration }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://unpkg.com/vue"></script>
<script rel="stylesheet" src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/plyr"></script>
<script src="https://unpkg.com/vue-plyr"></script>
<script>

    var id = JSON.parse('<?=json_encode($_GET);?>').id;

    new Vue({
        el: '#app',
        data: {
            id_video: id,
            data_response: [],
        },
        created() {
            var ctx = this;
            const data = new FormData();
            data.append('id', ctx.id_video);

            axios({
                url: 'https://b24apps.ru/local/b24apps/our_app/ipeye/php/getVideoId.php',
                method: 'POST',
                data: data
            }).then((response) => {

                response.data.preview = 'data:image/jpeg;base64,' + response.data.preview;
                ctx.data_response = response.data;
                console.log(ctx.data_response)
            });
        }
    })
</script>
</body>
</html>
