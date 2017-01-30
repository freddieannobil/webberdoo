<?php
namespace Webberdoo\AppBundle\Service;

class Notify
{

    public function loginToLike()
    {
        ?>
        <script>
            loginToLike();
        </script>
        <?php
    }

    public function registerWithProviderSuccess()
    {
        ?>

        <script>
            registerWithProviderSuccess();
        </script>

        <?php
    }

    public function likeSuccess()
    {
        ?>
        <script>
            likeSuccess();
        </script>
        <?php
    }

    public function likeRemoved()
    {
        ?>
        <script>
            likeRemoved();
        </script>
        <?php
    }

    public function unlikeSuccess()
    {
        ?>
        <script>
            unlikeSuccess();
        </script>
        <?php
    }

    public function unlikeRemoved()
    {
        ?>
        <script>
            unlikeRemoved();
        </script>
        <?php
    }
}
