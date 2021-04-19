<?php


namespace app\core;


abstract class DbModel extends Model
{
    /**
     * Methods for DbModel class.
     */
    abstract public function primaryKey(): string;
    abstract public function tableName(): string;
    abstract public function attributes(): array;

    /**
     * @return bool
     */
    public function save(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr)=>":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).")
            VALUES (".implode(',', $params).")");
        foreach ($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    /**
     * @param $sql
     * @return \PDOStatement
     */
    public static function prepare($sql): \PDOStatement
    {
        return Application::$app->db->pdo->prepare($sql);
    }


    public function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND ", array_map(fn($attr)=>"$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item){
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName;");
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * @param $params
     * @param $id
     * @return bool
     */
    public function edit($params, $id): bool
    {
        $tableName = static::tableName();
        $statement = self::prepare("
            UPDATE $tableName 
            SET firstname='$params[firstname]',
             lastname='$params[lastname]', 
             age='$params[age]', 
             gender='$params[gender]', 
             class='$params[class]',
             faculty='$params[faculty]'
             WHERE id=$id;");
        $statement->execute();
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $tableName = static::tableName();
        $statement = self::prepare("DELETE FROM $tableName WHERE id=$id;");
        $statement->execute();
        return true;
    }
}