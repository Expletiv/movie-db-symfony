import {Controller} from "@hotwired/stimulus";
import Popover from 'bootstrap/js/dist/popover';

export default class extends Controller {

  private popovers: Popover[] = [];

  initialize() {
    const popoverTriggerList: NodeListOf<Element> = document.querySelectorAll('[data-bs-toggle="popover"]');
    this.popovers = [...popoverTriggerList].map(popoverTriggerEl => new Popover(popoverTriggerEl))
  }

  disconnect() {
    this.popovers.forEach(popover => popover.dispose());
    this.popovers = [];
  }

}
