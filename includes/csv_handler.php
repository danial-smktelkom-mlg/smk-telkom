<?php
class CSVHandler {
    private $file_path;

    public function __construct($file_path) {
        $this->file_path = $file_path;
    }

    public function readAll() {
        $data = [];
        if (file_exists($this->file_path)) {
            if (($handle = fopen($this->file_path, "r")) !== FALSE) {
                while (($row = fgetcsv($handle)) !== FALSE) {
                    $data[] = $row;
                }
                fclose($handle);
            }
        }
        return $data;
    }

    public function getById($id) {
        $data = $this->readAll();
        return isset($data[$id]) ? $data[$id] : null;
    }

    public function update($id, $new_data) {
        $data = $this->readAll();
        if (isset($data[$id])) {
            $data[$id] = $new_data;
            return $this->writeAll($data);
        }
        return false;
    }

    public function delete($id) {
        $data = $this->readAll();
        if (isset($data[$id])) {
            unset($data[$id]);
            return $this->writeAll(array_values($data));
        }
        return false;
    }

    public function add($new_data) {
        $data = $this->readAll();
        // Generate registration ID (timestamp + random number)
        $registration_id = time() . rand(1000, 9999);
        $new_data = array_merge([$registration_id], $new_data);
        $data[] = $new_data;
        return $this->writeAll($data);
    }

    public function findByRegistrationId($registration_id) {
        $data = $this->readAll();
        foreach ($data as $index => $row) {
            if ($row[0] === $registration_id) {
                return ['index' => $index, 'data' => $row];
            }
        }
        return null;
    }

    private function writeAll($data) {
        if (($handle = fopen($this->file_path, "w")) !== FALSE) {
            foreach ($data as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
            return true;
        }
        return false;
    }
}
?>