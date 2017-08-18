<?php

namespace MicroCMS\DAO;

use Doctrine\DBAL\Connection;
use MicroCMS\Domain\Perso;

class PersoDAO extends DAO
{
    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = "select * from t_perso order by perso_id asc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $persos = array();
        foreach ($result as $row) {
            $persoId = $row['perso_id'];
            $persos[$persoId] = $this->buildDomainObject($row);
        }
        return $persos;
    }
    /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id The article id.
     *
     * @return \MicroCMS\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from t_perso where perso_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No perso matching id " . $id);
    }

    /**
     * Saves an perso into the database.
     *
     * @param \MicroCMS\Domain\Article $perso The perso to save
     */
    public function save(Perso $perso) {
        $persoData = array(
            'perso_nom' => $perso->getNom(),
            'perso_prenom' => $perso->getPrenom(),
            'perso_poste' => $perso->getPoste(),
            'perso_img' => $perso->getImg(),
            'perso_facebook' => $perso->getFacebook(),
            'perso_github' => $perso->getGithub(),
            'perso_codepen' => $perso->getCodepen(),
            'perso_linkedin' => $perso->getLinkedin(),
            'perso_twitter' => $perso->getTwitter(),
            'perso_tel' => $perso->getTel(),
            'perso_adresse' => $perso->getAdresse(),
            );

        if ($perso->getId()) {
            // The perso has already been saved : update it
            $this->getDb()->update('t_perso', $persoData, array('perso_id' => $perso->getId()));
        } else {
            // The perso has never been saved : insert it
            $this->getDb()->insert('t_perso', $persoData);
            // Get the id of the newly created perso and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $perso->setId($id);
        }
    }

    /**
     * Removes an article from the database.
     *
     * @param integer $id The article id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('t_perso', array('perso_id' => $id));
    }

    /**
     * Creates an Experience object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \MicroCMS\Domain\Article
     */
    protected function buildDomainObject(array $row) {
        $perso = new Perso();
        $perso->setId($row['perso_id']);
        $perso->setNom($row['perso_nom']);
        $perso->setPrenom($row['perso_prenom']);
        $perso->setPoste($row['perso_poste']);
        $perso->setFacebook($row['perso_facebook']);
        $perso->setGithub($row['perso_github']);
        $perso->setCodepen($row['perso_codepen']);
        $perso->setLinkedin($row['perso_linkedin']);
        $perso->setTwitter($row['perso_twitter']);
        $perso->setImg($row['perso_img']);
        $perso->setTel($row['perso_tel']);
        $perso->setAdresse($row['perso_adresse']);
        return $perso;
    }
}
