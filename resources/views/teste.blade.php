<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            html, body {
                margin: 0;
                padding: 0;
                height: 100%;
                width: 100%;
                background-color: #d1d1d1
            }
        </style>
    </head>
    <body>
        <div style="margin-top: 2%; margin-left: 3%;">
            <div>
                <input type="hidden" id="inp_codigo">
                <div>
                    <label>Nome:</label>
                    <input type="text" id="inp_nome"/>
                </div>
                <div>
                    <label>Peso:</label>
                    <input type="text" id="inp_nome"/>
                </div>
                <div>
                    <label>Sexo:</label>
                    <input type="radio" id="inp_masculino" name="gender" value="m">
                    <label for="masculino">Masculino</label><br>
                    <input type="radio" id="inp_feminino" name="gender" value="f">
                    <label for="feminino">Feminino</label><br>
                </div>
                <div>
                    <label>Data aniversario:</label>
                    <input type="date" id="inp_data" value=""/>
                </div>
            </div>
            <button onclick="teste()">Salvar</button>

            <br />
            <br />
            <br />
            <br />
            <div>
                <table>
                    <thead>
                        <th>Nome</th>
                        <th>Peso</th>
                        <th>Sexo</th>
                        <th>Data de aniversário</th>
                        <th colspan="2">Opções</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Teste</td>
                            <td>12.12</td>
                            <td>Masculino</td>
                            <td><center>01/01/2020</center></td>
                            <td @click="alt">Alterar</td>
                            <td @click="del">Deletar</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    <script>
        function teste(){
            console.log( document.querySelector('input[name="gender"]:checked').value );
            if(document.querySelector('input[name="gender"]:checked').value != null){
                console.log('aa');
            }else{
                console.log('ab');

            }

        }
    </script>
</html>