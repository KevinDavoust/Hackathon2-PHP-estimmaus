import { Controller } from '@hotwired/stimulus';
import { Application } from '@hotwired/stimulus';
import PasswordVisibility from 'stimulus-password-visibility';

const application = Application.start();
application.register('password-visibility', PasswordVisibility)

export default class extends Controller {
    connect()
    {
        super.connect()
    }

    toggle(event)
    {
        super.toggle()
    }
}
