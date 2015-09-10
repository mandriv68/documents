<?php

class ViewPosts extends AbstractView {
    
    protected function getForm() {
?>   
        <form role="form" class="form-inline" method="post">
                    <fieldset>
                        <legend>добавление::редактирование должности</legend>
                        <div class="col-md-10 form-group">
                            <label for="postname">должность</label>
                            <input type="hidden" name="id" value="<?= $this->item_form->id?>">
                            <input type="text" name="postname" class="form-control w70" id="postname" placeholder="Введите название должности" value="<?= $this->item_form->postname?>">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-red">запомнить</button>
                        </div>
                        <? $visibility = ' hidden';
                            if($_SESSION['msgs']):
                                $visibility = ' visible';
                            endif;?>
                        <div class="msgs <?= $visibility.$_SESSION['msgs'][1]?>">
                            <i class="fa fa-comments-o"></i><?= $_SESSION['msgs'][0]?>
                        </div>
                    </fieldset>
                </form>
<?php
    }
    
    protected function getTable() {
?>
        <table class="table table-striped table-bordered">
            <tr bgcolor="grey">
                <th align="center" width="10%">id</th>
                <th align="center" >название должности</th>
                <th align="center" width="10%">ред...</th>
                <th align="center" width="10%">уд...</th>
            </tr>
<?      $count = 1;
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/posts/get/id/<?= $line->id?>';" class="hover-tr">
                <td align="center"><?= $count?></td>
                <td align="left"><?= $line->postname?></td>
                <td class="icon-edit">
                    <a href="/posts/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/posts/delete/id/<?= $line->id?>" title="удалить">
                        <i class="fa fa-eraser"></i>
                    </a>

                </td>
            </tr>
<?          $count++;
        endforeach;?>   
        </table>
<?php   }
    
    public function getBody() {
        $this->getHeader();
        $this->getNavbar(TRUE);
        $this->getContent();
        $this->getFooter();
    }
    
}
