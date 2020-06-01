<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/head.php' ?>

<div class="row justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card">
            <header class="card-header">
                <a href="" class="float-right btn btn-outline-primary mt-1">Войти</a>
                <h4 class="card-title mt-2">Регистрация</h4>
            </header>
            <article class="card-body">
                <form action="#" method="post">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label>Имя </label>
                            <input type="text" name="firstName"
                                   class="form-control <?php $errors['firstName'] ? print 'is-invalid' : false; ?>"
                                   value="<?php echo $firstName; ?>" required>
                            <?php $errors['firstName'] ?
                                print '<div class="invalid-feedback">'.$errors['firstName'].'</div>' : false; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Фамилия</label>
                            <input type="text" name="lastName"
                                   class="form-control <?php $errors['lastName'] ? print 'is-invalid' : false; ?>"
                                   value="<?php echo $lastName; ?>" required>
                            <?php $errors['lastName'] ?
                                print '<div class="invalid-feedback">'.$errors['lastName'].'</div>' : false; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email"
                               class="form-control <?php $errors['email'] ? print 'is-invalid' : false; ?>"
                               value="<?php echo $email; ?>" required>
                        <?php $errors['email'] ?
                            print '<div class="invalid-feedback">'.$errors['email'].'</div>' : false; ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Пол</label>
                            <select id="inputState" name="gender" class="form-control"
                                    value="<?php echo $gender; ?>">
                                <option>Мужской</option>
                                <option>Женский</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Дата рождения</label>
                            <input type="date" name="birthday"
                                   class="form-control <?php $errors['birthday'] ? print 'is-invalid' : false; ?>"
                                   value="<?php echo $birthday; ?>"
                                   min="1920-01-01"
                                   max="2050-01-01" >
                            <?php $errors['birthday'] ?
                                print '<div class="invalid-feedback">'.$errors['birthday'].'</div>' : false; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
                    </div>
                </form>
            </article>
            <div class="border-top card-body text-center">Уже есть аккаунт? <a href="">Войти</a></div>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php' ?>
