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
            var_dump($equiposFaltantes);

            foreach( $equiposFaltantes as $key => $informacion){

            }

            switch ($informacion) {
                case $this->W:
                    
                    break;
                
                default:
                    # code...
                    break;
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
                            break;

                        case 'draw':
                            $equipo1 = $this->equipos[$key-2];
                            $equipo2 = $this->equipos[$key-1];

                            ($this->D[$equipo1] ?? null) ? $this->D[$equipo1] += 1 : $this->D[$equipo1] = 1;
                            ($this->D[$equipo2] ?? null) ? $this->D[$equipo2] += 1 : $this->D[$equipo2] = 1;
                            break;

                        case 'loss':
                            $equipo1 = $this->equipos[$key-1];
                            $equipo2 = $this->equipos[$key-2];

                            ($this->W[$equipo1] ?? null) ? $this->W[$equipo1] += 1 : $this->W[$equipo1] = 1;
                            ($this->L[$equipo2] ?? null) ? $this->L[$equipo2] += 1 : $this->L[$equipo2] = 1;
                            break;
                        
                        default:
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

    echo json_encode($obj->MP, JSON_PRETTY_PRINT);
    echo json_encode($obj->W, JSON_PRETTY_PRINT);
    echo json_encode($obj->D, JSON_PRETTY_PRINT);
    echo json_encode($obj->L, JSON_PRETTY_PRINT);
?>