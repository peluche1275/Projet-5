    <h2 class="major">Contact</h2>
    <form method="post" action="#">
        <div class="fields">
            <div class="field half">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" required aria-required="true"/>
            </div>
            <div class="field half">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required aria-required="true"/>
            </div>
            <div class="field">
                <label for="message">Message</label>
                <textarea name="message" id="message" rows="4" required aria-required="true"></textarea>
            </div>
        </div>
        <ul class="actions">
            <li><input type="submit" value="Envoyer un message" class="primary" name="contact" /></li>
            <li><input type="reset" value="Reset" /></li>
        </ul>
    </form> 