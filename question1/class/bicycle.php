<?php
class Bicycle
{
    protected $gear_type;
    protected $gear_level;
    protected $wheel_size;
    protected $num_rings;
    public function __construct($gear_type, $gear_level, $wheel_size, $num_rings)
    {
        $this->gear_type = $gear_type;
        $this->gear_level = $gear_level;
        $this->wheel_size = $wheel_size;
        $this->num_rings = $num_rings;
    }

    // if gear type "cheap" num_spockets = 30 - 2 * gear_ratio
    // if gear type "expensive" num_spockets = 46 - floor(1.2 * gear_ratio)
    protected $num_spockets;
    protected function get_num_spockets($gear_type, $gear_level)
    {
        if ($gear_type == "cheap") {
            $this->num_spockets = 30 - 2 * $gear_level;
        } else {
            $this->num_spockets = 46 - floor(1.2 * $gear_level);
        }
    }

    protected $wheel_circum;
    protected function get_wheel_circum($wheel_size)
    {
        $this->wheel_circum = $wheel_size * pi();
    }

    protected $gear_ratio;
    protected function get_gear_ratio($num_rings, $num_spockets)
    {
        $this->gear_ratio = $num_rings / $num_spockets;
    }

    protected $one_rotation;
    protected function get_one_rotation($wheel_circum, $gear_ratio)
    {
        $this->one_rotation = $wheel_circum * $gear_ratio;
    }

    protected function gear_level_checker($gear_type, $gear_level)
    {
        if ($gear_type == "cheap") {
            if ($gear_level >= 1 && $gear_level <= 7) {
                echo "Valid gear level";
                return true;
            }
            return false;
        } elseif ($gear_type == "expensive") {
            if ($gear_level >= 1 && $gear_level <= 30) {
                echo "Valid gear level";
                return true;
            }
            return false;
        } else {
            echo "InValid Gear Type";
            return false;
        }
    }

    public function createBicycle()
    {
        // check if gear type is either cheap or expensive and if gear level is between 1 and 7 or 1 and 30
        if ($this->gear_level_checker($this->gear_type, $this->gear_level)) {
            echo "Gear type and gear level are valid";
        } else {
            return false;
        }


        $this->get_num_spockets($this->gear_type, $this->gear_level); //update spockets
        $this->get_wheel_circum($this->wheel_size);
        $this->get_gear_ratio($this->num_rings, $this->num_spockets); // update gear ratio

        $this->get_one_rotation($this->wheel_circum, $this->gear_ratio); // update one rotation

        // create a bicyle and store it in bicycleDB.db
        $pdo = new PDO('sqlite:../db/bicycleDB.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // insert everything into the table
        $sql = "INSERT INTO bicycleDB (gear_type, gear_level, wheel_size, num_rings, num_spockets, wheel_circum, gear_ratio, one_rotation) VALUES (:gear_type, :gear_level, :wheel_size, :num_rings, :num_spockets, :wheel_circum, :gear_ratio, :one_rotation)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':gear_type', $this->gear_type);
        $stmt->bindParam(':gear_level', $this->gear_level);
        $stmt->bindParam(':wheel_size', $this->wheel_size);
        $stmt->bindParam(':num_rings', $this->num_rings);
        $stmt->bindParam(':num_spockets', $this->num_spockets);
        $stmt->bindParam(':wheel_circum', $this->wheel_circum);
        $stmt->bindParam(':gear_ratio', $this->gear_ratio);
        $stmt->bindParam(':one_rotation', $this->one_rotation);

        $stmt->execute();
        return true;
    }

    public function increaseGear($id)
    {
        // get the gear type and gear level from the database
        $pdo = new PDO('sqlite:../db/bicycleDB.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $gear_type = $this->gear_type;
        $gear_level = $this->gear_level;
        $num_rings = $this->num_rings;
        $wheel_circum = $this->wheel_circum;

        // increase the gear level by 1
        $gear_level++;

        $validGear = $this->gear_level_checker($gear_type, $gear_level); // check if the gear level is valid
        if (!$validGear) {
            return false;
        }

        $this->get_num_spockets($gear_type, $gear_level); //update spockets
        $this->get_gear_ratio($num_rings, $this->num_spockets); // update gear ratio
        $this->get_one_rotation($wheel_circum, $this->gear_ratio); // update one rotation

        // update everything in the database
        $sql = "UPDATE bicycleDB SET gear_level = :gear_level, num_spockets = :num_spockets, gear_ratio = :gear_ratio, one_rotation = :one_rotation WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':gear_level', $gear_level);
        $stmt->bindParam(':num_spockets', $this->num_spockets);
        $stmt->bindParam(':gear_ratio', $this->gear_ratio);
        $stmt->bindParam(':one_rotation', $this->one_rotation);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return true;
    }

    public function decreaseGear($id)
    {
        $pdo = new PDO('sqlite:../db/bicycleDB.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $gear_type = $this->gear_type;
        $gear_level = $this->gear_level;
        $num_rings = $this->num_rings;
        $wheel_circum = $this->wheel_circum;

        // decrease the gear level by 1 
        $gear_level--;

        $validGear = $this->gear_level_checker($gear_type, $gear_level); // check if the gear level is valid
        if (!$validGear) {
            return false;
        }

        $this->get_num_spockets($gear_type, $gear_level); //update spockets
        $this->get_gear_ratio($num_rings, $this->num_spockets); // update gear ratio
        $this->get_one_rotation($wheel_circum, $this->gear_ratio); // update one rotation

        // update everything in the database
        $sql = "UPDATE bicycleDB SET gear_level = :gear_level, num_spockets = :num_spockets, gear_ratio = :gear_ratio, one_rotation = :one_rotation WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':gear_level', $gear_level);
        $stmt->bindParam(':num_spockets', $this->num_spockets);
        $stmt->bindParam(':gear_ratio', $this->gear_ratio);
        $stmt->bindParam(':one_rotation', $this->one_rotation);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return true;
    }

    public function cycle(int $num_rotations): float
    {
        $one_rotation = $this->one_rotation;
        return $one_rotation * $num_rotations;
    }
}

class EditBicycle extends Bicycle
{
    public function __construct($id)
    {
        $pdo = new PDO('sqlite:../db/bicycleDB.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM bicycleDB WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception("No bicycle with that id");
        }
        $this->id = $row['id'];
        $this->gear_type = $row['gear_type'];
        $this->gear_level = $row['gear_level'];
        $this->wheel_size = $row['wheel_size'];
        $this->num_rings = $row['num_rings'];
        $this->num_spockets = $row['num_spockets'];
        $this->wheel_circum = $row['wheel_circum'];
        $this->gear_ratio = $row['gear_ratio'];
        $this->one_rotation = $row['one_rotation'];
    }
}
