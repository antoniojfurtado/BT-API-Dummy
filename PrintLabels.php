<?php

require('fpdf/fpdf.php');

class PrintLabels
{

    private $top_margin;
    private $side_margin;
    private $vertical_pitch;
    private $horizontal_pitch;
    private $label_height;
    private $label_width;
    private $labels_across;
    private $labels_along;
    private $labels;
    private $errors;

    /**
     * @param mixed $top_margin
     */
    private function setTopMargin($top_margin)
    {
        $this->top_margin = is_numeric($top_margin) ? $top_margin : NULL;
    }

    /**
     * @param mixed $side_margin
     */
    private function setSideMargin($side_margin)
    {
        $this->side_margin = is_numeric($side_margin) ? $side_margin : NULL;
    }

    /**
     * @param mixed $vertical_pitch
     */
    private function setVerticalPitch($vertical_pitch)
    {
        $this->vertical_pitch = is_numeric($vertical_pitch) ? $vertical_pitch : NULL;
    }

    /**
     * @param mixed $horizontal_pitch
     */
    private function setHorizontalPitch($horizontal_pitch)
    {
        $this->horizontal_pitch = is_numeric($horizontal_pitch) ? $horizontal_pitch : NULL;
    }

    /**
     * @param mixed $label_height
     */
    private function setLabelHeight($label_height)
    {
        $this->label_height = is_numeric($label_height) ? $label_height : NULL;
    }

    /**
     * @param mixed $label_width
     */
    private function setLabelWidth($label_width)
    {
        $this->label_width = is_numeric($label_width) ? $label_width : NULL;
    }

    /**
     * @param mixed $labels_across
     */
    private function setLabelsAcross($labels_across)
    {
        $this->labels_across = is_numeric($labels_across) ? $labels_across : NULL;
    }

    /**
     * @param mixed $labels_along
     */
    private function setLabelsAlong($labels_along)
    {
        $this->labels_along = is_numeric($labels_along) ? $labels_along : NULL;
    }

    /**
     * @param mixed $labels
     */
    public function setLabels($labels)
    {
        $this->labels = is_array($labels) ? $labels : NULL;
    }

    private function property_isset($property)
    {
        if (property_exists($this, $property) && isset($this->{$property})) {
            return TRUE;
        }
        return FALSE;
    }


    public function AddLabelsToPdf() {

        if(

            $this->property_isset('top_margin') &&
            $this->property_isset('side_margin') &&
            $this->property_isset('vertical_pitch') &&
            $this->property_isset('horizontal_pitch') &&
            $this->property_isset('label_height') &&
            $this->property_isset('label_width') &&
            $this->property_isset('labels_across') &&
            $this->property_isset('labels_along') &&
            !empty($this->labels)

        ) {

            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Helvetica', 'B', 10);
            $pdf->SetMargins(0, 0);
            $pdf->SetAutoPageBreak(false);
            $x = $y =  $x_across = $y_across = 0;

            foreach($this->labels as $label) {

                $x = $this->side_margin + ($this->horizontal_pitch * $x_across);
                $y = $this->top_margin + ($this->vertical_pitch * $y_across);
                $pdf->SetXY($x, $y);
                $pdf->MultiCell($this->label_width, $this->label_height, $label, 1, 'C');


                $y_across++; // next row
                if($y_across == $this->labels_along) { // end of page wrap to next column
                    $x_across++;
                    $y_across = 0;
                    if($x_across == $this->labels_across) { // end of page
                        $x_across = 0;
                        $y_across = 0;
                        $pdf->AddPage();
                    }
                }
            }
            $pdf->Output('Labels.pdf', 'D');
        } else {
            print "Labels data or config data not present";
        }


    }

    public function setConfig($config) {

            $this->setHorizontalPitch($config['HORIZONTAL_PITCH']);
            $this->setVerticalPitch($config['VERTICAL_PITCH']);
            $this->setTopMargin($config['TOP_MARGIN']);
            $this->setSideMargin($config['SIDE_MARGIN']);
            $this->setLabelHeight($config['LABEL_HEIGHT']);
            $this->setLabelWidth($config['LABEL_WIDTH']);
            $this->setLabelsAcross($config['LABELS_ACROSS']);
            $this->setLabelsAlong($config['LABELS_ALONG']);
    }
}