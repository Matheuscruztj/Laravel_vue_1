<template>
    <div style="margin-top: 2%; margin-left: 3%;">
        <div>
            <input type="hidden" id="inp_codigo" value="">
            <div>
                <label>Nome:</label>
                <input type="text" id="inp_nome"/>
            </div>
            <div>
                <label>Peso:</label>
                <input type="text" id="inp_peso"/>
            </div>
            <div>
                <label>Sexo:</label>
                <input type="radio" id="inp_masculino" name="gender" value="m" checked="checked">
                <label for="masculino">Masculino</label><br>
                <input type="radio" id="inp_feminino" name="gender" value="f">
                <label for="feminino">Feminino</label><br>
            </div>
            <div>
                <label>Data aniversario:</label>
                <input type="date" id="inp_data" value=""/>
            </div>
        </div>
        <button @click="upsert">Salvar</button>

        <br />
        <br />
        <br />
        <br />
        <div>
            <table>
                <thead>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Peso</th>
                    <th>Sexo</th>
                    <th>Data de aniversário</th>
                    <th colspan="2">Opções</th>
                </thead>
                <tbody>
                    <tr v-for="obj in obj_list"
                     v-bind="obj" :key="obj.id"
                    >
                        <td>{{ obj.id }}</td>
                        <td>{{ obj.name }}</td>
                        <td>{{ obj.weight }}</td>
                        <td>{{ obj.gender === 'm' ? 'Masculino' : 'Feminino' }}</td>
                        <td><center>{{ dataTrad(obj.birthdate) }}</center></td>
                        <td @click="alt(obj.id)" style="cursor: pointer;">Alterar</td>
                        <td @click="del(obj.id)" style="cursor: pointer;">Deletar</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import moment from 'moment';

    export default {
        data(){
            return {
                obj_list : [],
                mute: false
            }
        },
        methods: {
            dataTrad : function (date) {
                return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
            },
            async list_all() {
                const { data } = await window.axios.get('/api/crud');
                this.obj_list = [];
                data.forEach(obj => this.obj_list.push(obj))
            },
            async del(valor){
                await window.axios.delete(`/api/crud/${valor}`)
                .then(function (response) {
                    // const { data } = response;
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.list_all();
            },
            async alt(valor) {
                await window.axios.get(`/api/crud/${valor}`)
                .then(function (response) {
                    const { data } = response;
                    document.getElementById("inp_codigo").value = data.id;
                    document.getElementById("inp_nome").value = data.name;
                    document.getElementById("inp_peso").value = data.weight;

                    if(data.gender == 'm'){
                        document.getElementById("inp_masculino").checked = true;
                    }else{
                        document.getElementById("inp_feminino").checked = true;
                    }

                    // document.querySelector('input[name="gender"]:checked').value;
                    document.getElementById("inp_data").value = data.birthdate;
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.list_all();
            },
            async upsert() {
                let codigo = document.getElementById("inp_codigo").value;
                let nome = document.getElementById("inp_nome").value;
                let peso = Number(document.getElementById("inp_peso").value);
                let sexo = document.querySelector('input[name="gender"]:checked').value;
                let dt_aniversario = document.getElementById("inp_data").value;

                let json = JSON.stringify({
                    name: nome,
                    weight:peso,
                    gender:sexo,
                    birthdate:dt_aniversario 
                });
                console.log(json);

                if(codigo == null || codigo == "" || codigo == undefined){
                    await window.axios.post('/api/crud', {
                        name: nome,
                        weight:peso,
                        gender:sexo,
                        birthdate:dt_aniversario 
                    })
                    .then(function (response) {
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    this.list_all();
                }else{

                    await window.axios.put(`/api/crud/${codigo}`, {
                        name: nome,
                        weight:peso,
                        gender:sexo,
                        birthdate:dt_aniversario 
                    })
                    .then(function (response) {
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    this.list_all();
                }
            }
        },
        created(){
            this.list_all();
        }
    }
</script>