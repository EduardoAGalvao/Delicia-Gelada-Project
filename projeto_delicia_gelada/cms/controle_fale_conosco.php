<?php

  require_once('header.php');

?>

      <!--CONTEÚDO-->
      <div id="container_principal" class="center">
        
        <div class="item_contato" id="tipomensagem_cms">
          <label>Motivo do Contato:</label>
          <select name="slt_mensagem" id="slt_mensagem">
            <option selected value="null">Selecione:</option>
            <option value="sugestoes">Sugestões</option>
            <option value="criticas">Críticas</option>
          </select>
        </div>
      
        <table id="tabela_faleconosco">
          <tr>
            <th>Data do Contato</th>
            <th>Nome</th> 
            <th>Email</th>
            <th>Motivo</th>
            <th>Opções</th>
          </tr>
          
          <?php

            $sql = "SELECT * FROM tbl_contato WHERE data_exclusao IS NULL ORDER BY id_contato DESC";

            $select = mysqli_query($conexao, $sql);

            while($contato = mysqli_fetch_assoc($select)){
        
          ?>
          
          <tr class="motivo_<?= $contato['motivo_contato']; ?>" >
            
            <?php
            
              $dataInsercao = explode("-", $contato['data_insercao']);
              $dataInsercao = $dataInsercao[2] . "/" . $dataInsercao[1] . "/" . $dataInsercao[0];
              
            ?>
            
            <td><?= $dataInsercao; ?></td>
            <td><?= $contato['nome']; ?></td>
            <td><?= $contato['email']; ?></td>
            <td><?= $contato['motivo_contato'] == "sugestoes" ? "Sugestão" : "Crítica"; ?></td>
            <td class="contato_acoes">
              <a href="#" onclick="visualizarDados(<?= $contato['id_contato']; ?>)">
                <div class="btn_visualizar"></div>
              </a>
              <a onclick="return confirm('Deseja realmente excluir o registro?');" href="../db/excluirContato.php?modo=excluir&codigo=<?= $contato['id_contato']; ?>">
                <div class="btn_excluir"></div>
              </a>
            </td>
          </tr>
          
          <?php
          
            }
              
          ?>
        </table>
        
      </div>

      <!--RODAPÉ-->
      <footer class="center">
        
        <div class="conteudo">
        
          <p>Desenvolvido por Eduardo A. Galvão | SENAI Prof Vicente Amato | 2019</p>
        
        </div>
        
      </footer>

    </div>
  </body>
</html>
