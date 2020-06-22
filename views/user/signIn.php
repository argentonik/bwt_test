<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <header class="card-header">
                <h4 class="card-title mt-2">Войти</h4>
            </header>
            <article class="card-body">
                <form action="#" method="post">
                    <div class="form-group">
                        <label>Имя </label>
                        <input type="text" name="firstName"
                               class="form-control <?php $errors['firstName'] ? print 'is-invalid' : false; ?>"
                               value="<?php echo $firstName; ?>" required>
                        <?php $errors['firstName'] ?
                            print '<div class="invalid-feedback">'.$errors['firstName'].'</div>' : false; ?>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email"
                               class="form-control <?php $errors['email'] ? print 'is-invalid' : false; ?>"
                               value="<?php echo $email; ?>" required>
                        <?php $errors['email'] ?
                            print '<div class="invalid-feedback">'.$errors['email'].'</div>' : false; ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Войти</button>
                    </div>
                </form>
            </article>
            <div class="border-top card-body text-center">Ещё нет аккаунта? <a href="/registration">Зарегистрироваться</a></div>
        </div>
    </div>
</div>