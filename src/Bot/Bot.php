<?php

namespace App\Bot;

use App\Faker\Faker;
use CzProject\GitPhp\Git;
use CzProject\GitPhp\GitException;
use CzProject\GitPhp\GitRepository;

class Bot
{
  private const REPO = '/repo';
  private const FILE = '/love.txt';
  private const DEFAULT_REMOTE = 'origin';
  public function __construct(private Git $git, private string $projectDir, private Faker $faker) {}

  public function play()
  {

    // Repo dir
    $repo = $this->git->open($this->projectDir . self::REPO);
    // Filename to be updated
    $filename = $repo->getRepositoryPath() . self::FILE;
    // Content for file
    $content = $this->faker->contentGenerator();
    // Writing file with new content
    file_put_contents($filename, $content);

    $currentDate = date('Y-m-d H:i:s');

    $repo->addFile($filename);
    $repo->commit("Update from bot on {$currentDate}");

    $this->pushToRemote($repo);

    return 'Done';
  }

  public function pushToRemote(GitRepository $repo, string $remoteName = self::DEFAULT_REMOTE)
  {
    try {
      // First, check if the remote exists
      $remotes = $repo->execute(['remote']);
      $remoteExists = false;

      foreach ($remotes as $remote) {
        if (trim($remote) === $remoteName) {
          $remoteExists = true;
          break;
        }
      }

      if (!$remoteExists) {
        $remotesList = implode(', ', $remotes);
        throw new \Exception("Remote '$remoteName' doesn't exist. Available remotes: $remotesList");
      }

      // Try to push to the specified remote
      $repo->push($remoteName);

      return true;
    } catch (GitException $e) {
      echo "Git push failed: {$e->getMessage()}\n";

      throw $e;
    }
  }
}
