<?php

require_once '../database/connection.php';

require_once "../utils/parse.php";

/**
 * Orm class abstract database logic for PDO and building queries for PHP syntax
 *
 * @author  Alisson Oliveira
 * @license MIT
 */
class Orm {

    /**
     * @var PDO $database PDO
     */
    public $database;

    /**
     * @var string $table string
     */
    public $table;

    public function __construct($table) {
        $this->database = (new Connection())->connection;
        $this->table = $table;
    }

    /**
     * Select in database
     *
     * Use to select values from a table in database
     * 
     * @param string[]|null $columns Pass table columns or empty array to all columns
     * @param string|null $where Pass where rule or null to get all registers
     * 
     * @throws PDO\Exception
     * 
     * @return $query Returns fetched data from table
     */
    public function select($columns = [], $where = "") {
        try {
            $tableColumns = "*";
            if(count($columns) > 0) $tableColumns = implode(', ', $columns);

            $query = "SELECT " . $tableColumns . " FROM " . $this->getTable();

            if(strlen($where) > 0) $query .= " WHERE " . $where;

            return $this->database->query($query)->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $error) {
            return $error;
        }
    }

    /**
     * Insert in database
     *
     * Use to insert rows in a table
     * 
     * @param string[] $columns Pass table columns
     * @param string[] $values Pass new register values
     * 
     * @throws PDO\Exception
     * 
     * @return $query Returns new inserted data from table
     */
    public function insert($columns, $values) {
        try {
            $tableColumns = implode(', ', $columns);
            $rowValues = implode(', ', parseQueryValues($values));

            $query = $this->database->prepare("INSERT INTO " . $this->getTable() . " (" . $tableColumns . ") VALUES (" . $rowValues . ")")->execute();

            if($query) {
                $insertedData = array_combine($columns, $values);
                $insertedData['id'] = $this->database->lastInsertId();

                return $insertedData;
            }
        } catch(Exception $error) {
            return $error;
        }
    }

    /**
     * Update in database
     *
     * Use to update rows in a table
     * 
     * @param string $id Updating data ID
     * @param object $body Pass new register values and columns
     * 
     * @throws PDO\Exception
     * 
     * @return $query Returns new updated data from table
     */
    public function update($id, $body) {
        try {
            $query = $this->database->prepare("UPDATE " . $this->getTable() . " SET " . parseQueryKeyValue($body) . " WHERE id = " . $id)->execute();

            if($query) return $body;
        } catch (Exception $error) {
            return $error;
        } 
    }

    /**
     * Delete in database
     *
     * Use to delete rows in a table
     * 
     * @param string $where Pass where rule
     * 
     * @throws PDO\Exception
     * 
     * @return $query Returns true if the delete was successful
     */
    public function delete($where) {
        try {
            return $this->database->prepare("DELETE FROM " . $this->getTable() . " WHERE " . $where)->execute();
        } catch(Exception $error) {
            return $error;
        }
    }

    public function getTable () {
        return $this->table;
    }
}