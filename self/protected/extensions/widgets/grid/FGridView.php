<?php

Yii::import('zii.widgets.grid.CGridView');
class FGridView extends CGridView {

    public function renderMyContent ()
    {
        if($this->dataProvider->getItemCount()>0 || $this->showTableOnEmpty)
        {
            echo '<table class="table table-bordered table-striped table-hover">';
            $this->renderTableHeader();
            ob_start();
            $this->renderTableBody();
            $body=ob_get_clean();
            $this->renderTableFooter();
            echo $body; // TFOOT must appear before TBODY according to the standard.
            echo "</table>";
        }
        else
            $this->renderEmptyText();
    }

    public function renderTableHeader()
    {
        if(!$this->hideHeader)
        {
            echo "<thead>";

            if($this->filterPosition===self::FILTER_POS_HEADER)
                $this->renderFilter();

            echo "<tr>";
            foreach($this->columns as $column){
                echo '<th class="tl"><div>'.$column->name.'</div></th>';
            }

            echo "</tr>";

            if($this->filterPosition===self::FILTER_POS_BODY)
                $this->renderFilter();

            echo "</thead>\n";
        }
        elseif($this->filter!==null && ($this->filterPosition===self::FILTER_POS_HEADER || $this->filterPosition===self::FILTER_POS_BODY))
        {
            echo "<thead>\n";
            $this->renderFilter();
            echo "</thead>\n";
        }
    }

    public function renderTableBody()
    {
        $data=$this->dataProvider->getData();
        $n=count($data);
        echo "<tbody>\n";

        if($n>0)
        {
            foreach ($data as $row) {
                echo '<tr ><td><div>'.$row->id.'</div></td>';
                echo '<td><div>'.$row->cityname.'</div></td>';
                echo '<td><div>'.$row->cityname.'</div></td>';
                echo '<td><div>'.$row->cityname.'</div></td></tr>';
            }
        }
        else
        {
            echo '<tr><td colspan="10">没有符合条件的记录</td></tr>';
        }
        echo "</tbody>\n";
    }

}