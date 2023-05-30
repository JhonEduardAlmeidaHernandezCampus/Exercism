<?php
    header("Content-Type: application/json");

    class Tournament{
        public $MP = [];
        public $W = [];
        public $D = [];
        public $L = [];
        public $P = [];

        public function __construct($score){
            $this->equipos = explode(";", $score);
        }

        public function darPuntuacion($informacion){
            $equiposFaltantes = array_diff_key($this->MP, $informacion);

            foreach( $equiposFaltantes as $key => $value){
                switch ($informacion) {
                    case $this->W:
                        $informacion[$key] = 0;
                        $this->W = $informacion;
                        break;

                    case $this->D:
                        $informacion[$key] = 0;
                        $this->D = $informacion;
                        break;

                    case $this->L:
                        $informacion[$key] = 0;
                        $this->L = $informacion;
                        break;

                    case $this->P:
                        $informacion[$key] = 0;
                        $this->P = $informacion;
                        break;
                }
            }
        }

        public function asignarPuntos(){
            foreach($this->equipos as $key => $value){
                if($key%3 == 2){
                    switch ($this->equipos[$key]) {
                        case 'win':
                            $equipo1 = $this->equipos[$key-2];
                            $equipo2 = $this->equipos[$key-1];

                            ($this->W[$equipo1] ?? null) ? $this->W[$equipo1] += 1 : $this->W[$equipo1] = 1; // Le estamos sumando un punto al ganador del partido
                            ($this->L[$equipo2] ?? null) ? $this->L[$equipo2] += 1 : $this->L[$equipo2] = 1; // Le estamos sumando un punto al perdedor del partido
                            ($this->P[$equipo1] ?? null) ? $this->P[$equipo1] += 3 : $this->P[$equipo1] = 3;
                            break;

                        case 'draw':
                            $equipo1 = $this->equipos[$key-2];
                            $equipo2 = $this->equipos[$key-1];

                            ($this->D[$equipo1] ?? null) ? $this->D[$equipo1] += 1 : $this->D[$equipo1] = 1;
                            ($this->D[$equipo2] ?? null) ? $this->D[$equipo2] += 1 : $this->D[$equipo2] = 1;
                            ($this->P[$equipo1] ?? null) ? $this->P[$equipo1] += 1 : $this->P[$equipo1] = 1;
                            ($this->P[$equipo2] ?? null) ? $this->P[$equipo2] += 1 : $this->P[$equipo2] = 1; 
                            break;

                        case 'loss':
                            $equipo1 = $this->equipos[$key-1];
                            $equipo2 = $this->equipos[$key-2];

                            ($this->W[$equipo1] ?? null) ? $this->W[$equipo1] += 1 : $this->W[$equipo1] = 1;
                            ($this->L[$equipo2] ?? null) ? $this->L[$equipo2] += 1 : $this->L[$equipo2] = 1;

                            ($this->P[$equipo1] ?? null) ? $this->P[$equipo1] += 3 : $this->P[$equipo1] = 3;
                            break;
                    }
                } else{
                    ($this->MP[$this->equipos[$key]] ?? null) ? $this->MP[$this->equipos[$key]] += 1 : $this->MP[$this->equipos[$key]] = 1; 
                }
            }
            $this->darPuntuacion($this->W);
            $this->darPuntuacion($this->D);
            $this->darPuntuacion($this->L);
            $this->darPuntuacion($this->P);
        }
    }

    $obj = new Tournament("Allegoric Alaskans;Blithering Badgers;win;Devastating Donkeys;Courageous Californians;draw;Devastating Donkeys;Allegoric Alaskans;win;Courageous Californians;Blithering Badgers;loss;Blithering Badgers;Devastating Donkeys;loss;Allegoric Alaskans;Courageous Californians;win");
    $obj->asignarPuntos();

    function printRow($team, $mp, $w, $d, $l, $p) {
        $row = sprintf("%-30s | %-2s | %-2s | %-2s | %-2s | %-2s", $team, $mp, $w, $d, $l, $p);
        echo $row . PHP_EOL;
    }

    printRow("Team", "MP", "W", "D", "L", "P");
        foreach ($obj->MP as $team => $mp) {
        printRow($team, $mp, $obj->W[$team], $obj->D[$team], $obj->L[$team], $obj->P[$team]);
    }
?>