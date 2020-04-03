<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="assets/css/style.css">

<div id="app">
    <div class="container" :class="{'active': modal}">

        <div class="table" v-if="cameras.length != 0">
            <table>
                <tr class="header_table">
                    <td>Название камеры</td>
                    <td class='center'>ID камеры</td>
                </tr>
                <tr v-for="item in cameras">
                    <td>{{item.PROPERTY_VALUES.name_camera}}</td>
                    <td class='center'>{{item.PROPERTY_VALUES.id_camera}}</td>
                </tr>
            </table>
        </div>

        <span class="information" v-if="cameras.length == 0">
         У Вас не ниодной камеры
        </span>

        <button class="button" @click="modal = !modal">Добавить камеру</button>
        <span class="video_i">
            Незнаете как добавить камеру? <a href="https://www.youtube.com/watch?v=6bG-nQVkvcc" target="_blank">Посмотрите видео</a> инструкцию.
        </span>
    </div>

    <div class="modal" v-if="modal">
        <div class="modal_container">
            <span class="close" @click="modal = !modal">X</span>
            <h1>Добавление камеры</h1>

            <input type="text" placeholder="Имя камеры" v-model="name_camera">
            <input type="text" placeholder="ID камеры" v-model="id_camera">

            <button class="button" @click="addCamera" >Добавить камеру</button>
        </div>
    </div>
</div>



<script>
    var request = <?php echo json_encode($_REQUEST)?>
</script>
<script src="//api.bitrix24.com/api/v1/"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="assets/js/setting.js"></script>