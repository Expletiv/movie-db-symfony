import {Controller} from "@hotwired/stimulus";
import Popover from 'bootstrap/js/dist/popover';
import Tooltip from 'bootstrap/js/dist/tooltip';

export default class extends Controller {

  private popovers: Popover[] = [];
  private tooltips: Tooltip[] = [];

  initialize() {
    const popoverTriggerList: NodeListOf<Element> = document.querySelectorAll('[data-bs-toggle="popover"]');
    this.popovers = [...popoverTriggerList].map(popoverTriggerEl => new Popover(popoverTriggerEl));
    const tooltipTriggerList: NodeListOf<Element> = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    this.tooltips = [...tooltipTriggerList].map(tooltipTriggerEl => new Tooltip(tooltipTriggerEl));
  }

  disconnect() {
    this.popovers.forEach(popover => popover.dispose());
    this.popovers = [];
    this.tooltips.forEach(tooltip => tooltip.dispose());
    this.tooltips = [];
  }

}
