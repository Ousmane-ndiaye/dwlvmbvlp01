<?php

namespace App;

class GestionDeslogs
{
    const PATH_TO_LOGG = '/var/log/';

    public function addLogg($typeAction, $request, $user = '', $description = '')
    {
        $date = new \DateTime('now');
        $fileLog = $this->getCurrentLoggerFile();
        fprintf($fileLog,
            '%s -- [%s] -- %s -- KOCC DIGITALL -- %s -- %s -- %s -- %s -- %s'."\n",
            $request->getClientIp(),
            $date->format('Y-m-d H:i:s'),
            ucfirst($typeAction),
            $user ? $user->getIpAdress() : '',
            $user ? implode(' & ', $user->getRoles()) : '',
            $description,
            $request->getMethod().' '.$request->getPathInfo(),
            $request->headers->get('User-Agent')
        );
        fclose($fileLog);

        return 'ok';
    }

    //Crée le fichier s'il n'éxiste pas ou s'il est supérieur a 5 MB.
    public function getCurrentLoggerFile()
    {
        $date = new \DateTime('now');
        $logOfDayFiles = array_values(preg_grep('~^'.$date->format('Y-m-d').'.*\.(log)$~', scandir(dirname(__DIR__).self::PATH_TO_LOGG, SCANDIR_SORT_DESCENDING)));
        (count($logOfDayFiles) > 0) ? $name = $logOfDayFiles[0] : $name = '';
        $filename = dirname(__DIR__).self::PATH_TO_LOGG.$name;
        if (is_file($filename) && file_exists($filename)) {
            $fileLog = fopen($filename, 'a');
        } else {
            $filename = dirname(__DIR__).self::PATH_TO_LOGG.$date->format('Y-m-d').'.log';
            $fileLog = fopen($filename, 'w');
        }

        return $fileLog;
    }
}
