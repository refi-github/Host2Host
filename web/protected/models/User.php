<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    const ROLE_ADMIN = 1;
    const ROLE_STAFF = 2;
    const ROLE_PARTNER = 3;

    const PAGE_SIZE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'name', 'username', 'password'], 'required'],
            [['role', 'partner_id'], 'integer'],
            [['name', 'password', 'access_token'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'name' => 'Name',
            'username' => 'Username',
            'password' => 'Password',
            'partner_id' => 'Partner',
            'access_token' => 'Access Token',
        ];
    }

    public static function getAll($params)
    {
        $query = self::find()
            ->asArray();

        $query->offset($params['offset'])
            ->limit($params['limit'])
            ->orderBy(['id' => SORT_DESC]);

        return $query->all();
    }

    public static function countAll()
    {
        return self::find()
            ->count();
    }

    public static function getRoles($role = null)
    {
        $results = [
            self::ROLE_ADMIN => 'ADMIN',
            self::ROLE_STAFF => 'STAFF',
            self::ROLE_PARTNER => 'MITRA',
        ];

        if ($role != null) {
            return $results[$role];
        }

        return $results;
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()
            ->where(['access_token' => $token])
            ->andWhere(['!=', 'access_token', ''])
            ->one();
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password == sha1($password);
    }

    public function setPassword()
    {
        $this->password = sha1($this->password);
    }

    public static function generateAccessToken()
    {
        return md5(date("ymdhis") . rand(0, 99));
    }
}
