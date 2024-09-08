import {Controller} from "@hotwired/stimulus";

export default class extends Controller {

  static targets = ["iframe"];

  declare iframeTargets: HTMLIFrameElement[];

  stopVideos() {
    this.iframeTargets.forEach(iframe => {
      iframe.contentWindow?.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
    });
  }

}
