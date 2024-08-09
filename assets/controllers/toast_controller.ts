import {Controller} from "@hotwired/stimulus";
import Toast from 'bootstrap/js/dist/toast';

export default class extends Controller {

  private toasts: Toast[] = [];

  initialize() {
    const toastElList: NodeListOf<Element> = document.querySelectorAll('.toast');
    this.toasts = [...toastElList].map(toast => new Toast(toast));
  }

  connect() {
    for (const toast of this.toasts) {
      toast.show();
    }
  }

  disconnect() {
    for (const toast of this.toasts) {
      toast.hide();
      toast.dispose();
    }
    this.toasts = [];
  }

}
